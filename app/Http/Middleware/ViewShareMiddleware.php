<?php

namespace App\Http\Middleware;

use App\Repository\Library\LibraryRepository;
use App\Repository\UserSettings\UserSettingsRepository;
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
  private UserSettingsRepository $userSettingsRepository;

  public function __construct(UserSettingsRepository $userSettingsRepository, LibraryRepository $libraryRepository) {
    $this->libraryRepository = $libraryRepository;
    $this->userSettingsRepository = $userSettingsRepository;
  }

  public function handle(Request $request, Closure $next) {
    view()->share('favoriteGames', $this->libraryRepository->getFavorites());
    view()->share('currenciesList', ['PLN', 'USD']);
    view()->share('languagesList', ['polish', 'english']);
    if (Auth::user()) view()->share('userSettings', $this->userSettingsRepository->getSettings());
    return $next($request);
  }
}
