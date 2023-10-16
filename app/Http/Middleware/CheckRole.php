<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        
        if (auth()->check()) {
            $userRole = auth()->user()->role;
            if (in_array($userRole, $roles)) {
                return $next($request);
            }
            // Redirect or handle unauthorized access as needed
            return redirect()->back()->with('error', 'Unauthorized access.');
        }
    
        // Allow access to the home route for authenticated users
        return $next($request);
    }
}
