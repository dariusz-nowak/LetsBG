<?php

declare(strict_types=1);

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Repository\Game\GameRepository;
use App\Repository\Library\LibraryRepository;

class GameController extends Controller {

  private GameRepository $gameRepository;
  private LibraryRepository $libraryRepository;

  public function __construct(GameRepository $gameRepository, LibraryRepository $libraryRepository) {
    $this->gameRepository = $gameRepository;
    $this->libraryRepository = $libraryRepository;
  }

  public function add($gameId) {
    $this->gameRepository->add($this->gameRepository->getGame($gameId));
    return view('library.main', [
      'games' => $this->libraryRepository->getAll(),
    ]);
  }

  public function loadLobby() {
    dump('Lobby');
  }
}
