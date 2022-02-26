<?php

namespace App\Providers;

use App\Repository\Library\LibraryRepository;
use Illuminate\Support\ServiceProvider;

class ViewShareProvider extends ServiceProvider {
  /**
   * Register services.
   *
   * @return void
   */
  public function register() {
    //
  }

  /**
   * Bootstrap services.
   *
   * @return void
   */
  public function boot(LibraryRepository $libraryRepository) {
    view()->share('favoriteGames', $libraryRepository->getFavorites());
  }
}
