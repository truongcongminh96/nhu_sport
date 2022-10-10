<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param $role
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role): Response|RedirectResponse
    {
        if ($request->user()->role !== $role) return redirect('dashboard');
        return $next($request);
    }
}
