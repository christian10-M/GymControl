<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Mail\MembershipExpiring;

#[Signature('memberships:reminders')]
#[Description('Enviar recordatorios de membresías')]
class SendMembershipReminders extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tomorrow = Carbon::tomorrow()->toDateString();

        $users = User::whereHas('activeMembership', function ($query) use ($tomorrow) {

            $query->whereDate('end_date', $tomorrow);

        })->with('activeMembership')->get();

        foreach ($users as $user) {

            Mail::to($user->email)->queue(
                new MembershipExpiring($user)
            );

            $this->info("Correo enviado a {$user->email}");
        }

        return Command::SUCCESS;
    }
}
