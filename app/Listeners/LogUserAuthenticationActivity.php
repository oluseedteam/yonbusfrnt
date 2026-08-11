<?php

namespace App\Listeners;

use App\Models\ActivityLog;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Request;

class LogUserAuthenticationActivity
{
    public function handle($event): void
    {
        if ($event instanceof Login) {
            /** @var \App\Models\User $user */
            $user = $event->user;
            if ($user) {
                ActivityLog::create([
                    'user_id'     => $user->id,
                    'action'      => 'auth.login',
                    'description' => "User {$user->name} ({$user->email}) logged into the platform.",
                    'model_type'  => 'User',
                    'record_id'   => $user->id,
                    'ip_address'  => Request::ip(),
                    'user_agent'  => Request::userAgent(),
                ]);
            }
        } elseif ($event instanceof Logout) {
            /** @var \App\Models\User $user */
            $user = $event->user;
            if ($user) {
                ActivityLog::create([
                    'user_id'     => $user->id,
                    'action'      => 'auth.logout',
                    'description' => "User {$user->name} ({$user->email}) logged out of the platform.",
                    'model_type'  => 'User',
                    'record_id'   => $user->id,
                    'ip_address'  => Request::ip(),
                    'user_agent'  => Request::userAgent(),
                ]);
            }
        }
    }
}
