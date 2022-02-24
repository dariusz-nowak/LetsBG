<?php

declare(strict_types=1);

namespace App\Repository\Game;

use App\Models\Game;
use App\Models\User;
use App\Repository\GameRepository as GameRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class GameRepository implements GameRepositoryInterface {

  private Game $gameModel;
  private User $userModel;

  public function __construct(Game $gameModel, User $userModel) {
    $this->gameModel = $gameModel;
    $this->userModel = $userModel;
  }

  public function getGame($gameId) {
    return $this->gameModel->with('genres')->with('producers')->find($gameId);
  }

  public function add(Game $game) {
    return $this->userModel->games()->save($game, ['user_id' => Auth::user()->id]);
  }
}
