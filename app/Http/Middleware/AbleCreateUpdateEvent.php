<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Redirect;
use Symfony\Component\HttpFoundation\Response;

class AbleCreateUpdateEvent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if($user->role_id != 1)
        {
            return response('you cannot access this function',403);
        }

        return $next($request);
        // if(!$request->user() ||
        // ($request->user() instanceof MustVerifyEmail && 
        // ! $request->user()->hasVerifiedEmail()))
        // {
        //     return $request->expectsJson()
        //     ? abort(403,'Your email address is not verified')
        //     :Redirect::guest(URL::route($redirectToRoute ?: 'verification.notice'));
        // }
        // return $next($request);
    }
}
