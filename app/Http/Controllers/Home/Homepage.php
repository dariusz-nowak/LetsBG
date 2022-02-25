<?php

declare(strict_types=1);

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Repository\Library\LibraryRepository;

class Homepage extends Controller {

  private LibraryRepository $libraryRepository;

  public function __construct(LibraryRepository $libraryRepository) {
    $this->libraryRepository = $libraryRepository;
  }

  public function load() {
    return view('homepage', [
      'favoriteGames' => $this->libraryRepository->getFavorites(),
    ]);
  }
  public function redirect() {
    return redirect('/');
  }
}
