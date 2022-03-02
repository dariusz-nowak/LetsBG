<?php

namespace App\Http\Middleware;

use App\Repository\Library\LibraryRepository;
use App\Repository\User\UserRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewShareMiddleware {
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  private LibraryRepository $libraryRepository;
  private UserRepository $userRepository;

  public function __construct(UserRepository $userRepository, LibraryRepository $libraryRepository) {
    $this->libraryRepository = $libraryRepository;
    $this->userRepository = $userRepository;
  }

  public function handle(Request $request, Closure $next) {
    view()->share('favoriteGames', $this->libraryRepository->getFavorites());
    view()->share('currenciesList', ['PLN', 'USD']);
    view()->share('languagesList', ['polish', 'english']);
    if (Auth::user()) view()->share('userSettings', $this->userRepository->getSettings());
    return $next($request);
  }
}
