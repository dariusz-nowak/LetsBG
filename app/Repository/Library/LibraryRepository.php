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
      ->with(['users' => function ($query) {
        if (Auth::user()) $query->where('user_id', Auth::user()->id);
      }])
      ->whereHas('users', function ($query) {
        if (Auth::user()) $query->where('user_id', Auth::user()->id);
      })->get();
  }

  public function getGame($gameId) {
    return $this->gameModel->with('genres')->with('producers')->where('id', $gameId)->first();
  }

  public function checkGameStatus($gameId, $status) {
    $gameCollection = $this->gameModel->with('users')->whereHas('users', function ($query) use ($gameId) {
      $query->where('user_id', Auth::user()->id)->where('game_id', $gameId);
    })->get();

    if ($status == 'fav' || $status == 'hid') foreach ($gameCollection as $game) foreach ($game->users as $user) {
      if ($status == 'fav') {
        if (!$user->pivot->favorite) {
          $user->pivot->favorite = 1;
          $user->pivot->hidden = 0;
        } else $user->pivot->favorite = 0;
      } else if ($status == 'hid') {
        if (!$user->pivot->hidden) {
          $user->pivot->favorite = 0;
          $user->pivot->hidden = 1;
        } else $user->pivot->hidden = 0;
      };
      $user->pivot->save();
    };
  }

  public function getFavorites() {
    return $this->gameModel->with('genres')->with('producers')
      ->whereHas('users', function ($query) {
        $query->where('user_id', Auth::user()->id ?? '')->where('favorite', 1);
      })->get();
  }
}
