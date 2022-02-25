<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckGameStatus {
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next) {
    $statuses = ['fav', 'hid'];
    if (!in_array($request->route()->parameter('status'), $statuses)) return redirect('/');
    else return $next($request);
  }
}
