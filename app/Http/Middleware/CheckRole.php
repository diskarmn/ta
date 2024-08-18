<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {
         
        if (!Auth::guard('employee')->check()) {
            abort(Response::HTTP_FORBIDDEN, $this->getErrorMessage($role));
        }

        $user = $request->user();
        if ($user && $user->role !== $role) {

            abort(Response::HTTP_FORBIDDEN, $this->getErrorMessage($role));
        }

        return $next($request);
    }

    public function getErrorMessage($role) {
        return "Maaf, kamu tidak memiliki akses ke halaman ini. Diperlukan peran <strong>$role</strong> untuk mengakses.";
    }

}
