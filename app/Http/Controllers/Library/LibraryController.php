<?php

declare(strict_types=1);

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Repository\Library\LibraryRepository;

class LibraryController extends Controller {

  private LibraryRepository $libraryRepository;

  public function __construct(LibraryRepository $libraryRepository) {
    $this->libraryRepository = $libraryRepository;
  }

  public function checkGameStatus($gameId, $status) {
    $this->libraryRepository->checkGameStatus($gameId, $status);
    return redirect()->route('library.show');
  }

  public function show() {
    return view('library.main', [
      'games' => $this->libraryRepository->getAll()
    ]);
  }

  public function favorites() {
    return view('shared.load.favoriteGames', [
      'favoriteGames' => $this->libraryRepository->getFavorites()
    ]);
  }
  public function loadGameDetails($gameId) {
    return view('shared.load.loadGameDetails', [
      'game' => $this->libraryRepository->getGame($gameId),
      'rate' => $this->libraryRepository->getRates($gameId)->rating,
      'comment' => $this->libraryRepository->getRates($gameId)->comment
    ]);
  }
}
