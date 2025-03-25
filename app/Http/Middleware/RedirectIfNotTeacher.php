<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotTeacher
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('teacher')->check()) {
            return redirect()->route('teacher.login');
        }

        return $next($request);
    }
}