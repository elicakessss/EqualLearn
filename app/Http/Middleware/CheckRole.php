<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roleNames): Response
    {
        \Log::info('CheckRole middleware called for route: ' . $request->getPathInfo());
        \Log::info('Required roles: ' . implode(', ', $roleNames));
        
        if (!$request->user()) {
            \Log::info('User not authenticated');
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }

        $user = $request->user();
        $userRoles = $user->roles->pluck('name')->toArray();
        \Log::info('User: ' . $user->email . ' has roles: ' . implode(', ', $userRoles));

        // Simple fallback for any role issues
        if (empty($roleNames)) {
            \Log::info('No roles required, allowing access');
            return $next($request);
        }

        foreach ($roleNames as $roleName) {
            // Check if user has any of the required roles
            if ($user->roles->contains('name', $roleName)) {
                \Log::info('User has required role: ' . $roleName . ', allowing access');
                return $next($request);
            }
        }

        \Log::info('User does not have any of the required roles');
        return redirect()->route('home')->with('error', 
            'Access denied. You need the "' . implode(' or ', $roleNames) . '" role. Your current roles: ' . 
            (empty($userRoles) ? 'none' : implode(', ', $userRoles))
        );
    }
}
