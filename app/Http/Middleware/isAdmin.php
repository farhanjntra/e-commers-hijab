<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan user memiliki akses admin
        if (Auth::guest() || Auth::user()->isAdmin !== 'admin') {
            abort(403);
        }

        return $next($request);
    }
}
