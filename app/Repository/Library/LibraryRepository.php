<?php

declare(strict_types=1);

namespace App\Repository\Library;

use App\Models\Game;
use App\Repository\LibraryRepository as LibraryRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class LibraryRepository implements LibraryRepositoryInterface {
  private Game $gameModel;
  public function __construct(Game $gameModel) {
    $this->gameModel = $gameModel;
  }

  public function getAll() {
    return $this->gameModel->with('genres')->with('producers')
      ->whereHas('users', function ($query) {
        $query->where('user_id', Auth::user()->id);
      })
      ->paginate(24);
  }

  public function add($gameId) {
  }
}
