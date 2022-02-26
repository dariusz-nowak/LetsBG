<?php

namespace App\Http\Middleware;

use App\Repository\Library\LibraryRepository;
use Closure;
use Illuminate\Http\Request;

class ViewShareMiddleware {
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  private LibraryRepository $libraryRepository;
  public function __construct(LibraryRepository $libraryRepository) {
    $this->libraryRepository = $libraryRepository;
  }

  public function handle(Request $request, Closure $next) {
    view()->share('favoriteGames', $this->libraryRepository->getFavorites());
    return $next($request);
  }
}
