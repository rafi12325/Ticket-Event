<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// RBAC: dipakai sebagai middleware alias 'role:admin' / 'role:participant'
// Dual-mode: API → JSON 403, halaman web → halaman error 403
class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (! $request->user() || $request->user()->role !== $role) {
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'message' => "Akses ditolak: endpoint ini hanya untuk role '{$role}'.",
                ], 403);
            }

            abort(403, "Akses ditolak: halaman ini hanya untuk role '{$role}'.");
        }

        return $next($request);
    }
}
