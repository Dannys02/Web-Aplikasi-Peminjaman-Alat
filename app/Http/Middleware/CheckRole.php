<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(
    Request $request,
    Closure $next,
    string $role
  ): Response {
    if (!Auth::check() || Auth::user()->role->nama_role !== $role) {
      return redirect("dashboard")->with(
        "error",
        "Anda tidak punya akses
        untuk halaman ini!"
      );
    }

    return $next($request);
  }
}
