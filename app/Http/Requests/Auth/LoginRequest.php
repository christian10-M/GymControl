<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'access_key' => ['required', 'string'],
        ];
    }

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $user = \App\Models\User::where('access_key', $this->access_key)->first();

        if (!$user) {

            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'access_key' => 'Clave de acceso incorrecta.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Si es ADMIN
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'admin') {

            session([
                'admin_access_key' => $user->access_key
            ]);

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Login usuario normal
        |--------------------------------------------------------------------------
        */

        Auth::login($user);

        RateLimiter::clear($this->throttleKey());
    }

    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'access_key' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(
            Str::lower($this->input('access_key')).'|'.$this->ip()
        );
    }
}