<?php

declare(strict_types=1);

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Repository\Library\LibraryRepository;
use Illuminate\Http\Request;

class LibraryController extends Controller {

  private LibraryRepository $libraryRepository;
  private Request $request;

  public function __construct(LibraryRepository $libraryRepository, Request $request) {
    $this->libraryRepository = $libraryRepository;
    $this->request = $request;
  }

  public function checkGameStatus($gameId, $status) {
    $this->libraryRepository->checkGameStatus($gameId, $status);
    return redirect()->route('library.show');
  }

  public function show($gameId = null) {
    return view('library.main', [
      'games' => $this->libraryRepository->getAll(),
      'gameRated' => $gameId
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
  public function rate() {
    return $this->show($this->libraryRepository->rate($this->request->rate, $this->request->game));
  }
  public function comment() {
    return $this->show($this->libraryRepository->comment($this->request->comment, $this->request->game));
  }
}
