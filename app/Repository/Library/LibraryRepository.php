<?php

declare(strict_types=1);

namespace App\Repository\Library;

use App\Models\Game;
use App\Models\User;
use App\Repository\LibraryRepository as LibraryRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class LibraryRepository implements LibraryRepositoryInterface {
  private Game $gameModel;
  private User $userModel;

  public function __construct(Game $gameModel, User $userModel) {
    $this->gameModel = $gameModel;
    $this->userModel = $userModel;
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

  public function getRates($gameId) {
    return $this->userModel->where('id', Auth::user()->id)
      ->with(['rates' => function ($query) use ($gameId) {
        $query->where('user_id', Auth::user()->id)->where('game_id', $gameId);
      }])->first()->rates[0];
  }

  public function checkGameStatus($gameId, $status) {
    $game = $this->gameModel->with(['users' => function ($query) {
      $query->where('id', Auth::user()->id);
    }])->whereHas('users', function ($query) {
      $query->where('user_id', Auth::user()->id)->where('game_id', 1);
    })->first();

    if ($status == 'fav' || $status == 'hid') foreach ($game->users as $user) {
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

  public function rate($rate, $gameId) {
    $this->userModel->with(['rates' => function ($query) use ($gameId) {
      $query->where('user_id', Auth::user()->id)->where('game_id', $gameId);
    }])->first()->rates->first()->update(['rating' => $rate]);
  }

  public function comment($comment) {
    dump($comment);
  }
}
