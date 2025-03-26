<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckForWelcome
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Only redirect to welcome page if:
        // 1. User is authenticated
        // 2. User has not seen welcome screen
        // 3. User is not already on the welcome page or trying to logout
        if (
            $user &&
            !$user->has_seen_welcome &&
            !$request->routeIs('welcome') &&
            !$request->routeIs('welcome.decision') &&
            !$request->routeIs('logout')
        ) {
            return redirect()->route('welcome');
        }

        return $next($request);
    }
}
