<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request
     * @param  \Closure
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->is('admin/login')) {
            return $next($request);
        }
        if (
            Auth::check() &&
            (
                Auth::user()->hasRole('super_admin')
                || Auth::user()->hasRole('admin')
                || Auth::user()->hasRole('editor')
            )
        ) {
            return $next($request);
        }
        abort(403, 'Unauthorized access');
    }
}