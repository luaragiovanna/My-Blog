<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use \Illuminate\Auth;
use Symfony\Component\HttpFoundation\Response;

class MustBeAdministrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //do not allow not auth user to access
        /*if (auth()->user()?->username !== 'teste') {
            dd(auth()->user()); // Verifique se o usuário autenticado está sendo retornado corretamente

            abort(Response::HTTP_FORBIDDEN);
        }*/
        return $next($request);
    }
}
