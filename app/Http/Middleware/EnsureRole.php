<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userRole = auth()->user()->role;

        if (!in_array($userRole, $roles)) {
            $message = 'Access restricted: You do not have permission to access that section.';
            return match ($userRole) {
                'admin', 'superadmin', 'subadmin' => redirect()->route('admin.dashboard')->with('error', $message),
                'accountant'          => redirect()->route('accountant.dashboard')->with('error', $message),
                default               => redirect()->route('client.dashboard')->with('error', $message),
            };
        }

        return $next($request);
    }
}
