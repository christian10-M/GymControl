<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Nombre --}}
        <div>
            <x-input-label for="name" value="Nombre completo" />
            <x-text-input id="name" class="block mt-1 w-full" type="text"
                          name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        {{-- Email --}}
        <div class="mt-4">
            <x-input-label for="email" value="Correo electrónico" />
            <x-text-input id="email" class="block mt-1 w-full" type="email"
                          name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- CURP --}}
        <div class="mt-4">
            <x-input-label for="curp" value="CURP" />
            <x-text-input id="curp" class="block mt-1 w-full uppercase" type="text"
                          name="curp" :value="old('curp')" maxlength="18" required />
            <x-input-error :messages="$errors->get('curp')" class="mt-2" />
        </div>

        {{-- Clave de acceso --}}
        <div class="mt-4">
            <x-input-label for="access_key" value="Clave de acceso (número de socio)" />
            <x-text-input id="access_key" class="block mt-1 w-full uppercase" type="text"
                          name="access_key" :value="old('access_key')"
                          placeholder="Ej: GYM001" required />
            <x-input-error :messages="$errors->get('access_key')" class="mt-2" />
        </div>

        {{-- Edad --}}
        <div class="mt-4">
            <x-input-label for="age" value="Edad" />
            <x-text-input id="age" class="block mt-1 w-full" type="number"
                          name="age" :value="old('age')" min="14" max="99" required />
            <x-input-error :messages="$errors->get('age')" class="mt-2" />
        </div>

        {{-- Género --}}
        <div class="mt-4">
            <x-input-label for="gender" value="Género" />
            <select id="gender" name="gender"
                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm
                           focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">— Selecciona —</option>
                <option value="male"   {{ old('gender') == 'male'   ? 'selected' : '' }}>Masculino</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Femenino</option>
                <option value="other"  {{ old('gender') == 'other'  ? 'selected' : '' }}>Otro</option>
            </select>
            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
        </div>

        {{-- Contraseña --}}
        <div class="mt-4">
            <x-input-label for="password" value="Contraseña" />
            <x-text-input id="password" class="block mt-1 w-full" type="password"
                          name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Confirmar contraseña --}}
        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Confirmar contraseña" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                          name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <a class="underline text-sm text-gray-600 hover:text-gray-900"
               href="{{ route('login') }}">
                ¿Ya tienes cuenta?
            </a>
            <x-primary-button class="ms-4">
                Registrarse
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>