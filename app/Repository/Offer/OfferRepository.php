<?php

declare(strict_types=1);

namespace App\Repository\Offer;

use App\Models\Game;
use App\Models\User;
use App\Models\UsersCommentsLike;
use App\Models\UsersGamesComment;
use App\Repository\OfferRepository as OfferRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OfferRepository implements OfferRepositoryInterface {

  private Game $gameModel;
  private User $userModel;
  private UsersGamesComment $usersGamesCommentModel;

  public function __construct(Game $gameModel, User $userModel, UsersGamesComment $usersGamesCommentModel) {
    $this->gameModel = $gameModel;
    $this->userModel = $userModel;
    $this->usersGamesCommentModel = $usersGamesCommentModel;
  }

  public function getAll($user, $language) {
    $query = $this->gameModel->with('genres')->with('producers');
    if ($language) $query->where('language', $language);
    if ($user) $query = $query->with('users')->whereDoesntHave('users', function ($query) use ($user) {
      $query->where('user_id', $user->id);
    });
    return $query->paginate(12);
  }

  public function search($user, $categories, $languages, $ages, $producers, $request) {

    $result = $this->gameModel->with('genres')->with('producers')->with('users');

    if (!empty($request->phrase)) {
      $phrase = $request->phrase;
      $result = $result->where(function ($query) use ($phrase) {
        $query->orWhere('name', 'like', '%' . $phrase . '%')
          ->orWhere('description', 'like', '%' . $phrase . '%')
          ->orWhere('short_description', 'like', '%' . $phrase . '%');
      });
    }

    if (!empty($request->sort)) {
      if ($request->sort === 'newest') $result->orderBy('updated_at', 'desc');
      else if ($request->sort === 'bestsellers') $result->orderBy('sold', 'desc');
      else if ($request->sort === 'nameAsc') $result->orderBy('name', 'asc');
      else if ($request->sort === 'nameDesc') $result->orderBy('name', 'desc');
      else if ($request->sort === 'priceAsc') $result->orderBy('price', 'asc');
      else if ($request->sort === 'priceDesc') $result->orderBy('price', 'desc');
    }

    if (!empty($categories)) $result = $result->whereHas('genres', function ($query) use ($categories) {
      $query->whereIn('name', $categories);
    });

    if (!empty($producers)) $result = $result->whereHas('producers', function ($query) use ($producers) {
      $query->whereIn('name', $producers);
    });

    if (empty($request->free_only)) {
      if (!empty($min_price)) $result->where('price', '>=', $min_price);
      if (!empty($max_price)) $result->where('price', '<=', $max_price);
    } else $result->where('price', 0);

    if (!empty($languages)) $result = $result->whereIn('language', $languages);

    if (!empty($ages)) $result = $result->whereIn('min_age', $ages);

    if (!empty($request->promo)) $result = $result->whereHas('promotions');

    if (empty($request->owned) && $user) $result = $result->whereDoesntHave('users', function ($query) use ($user) {
      $query->where('user_id', $user->id);
    });

    return $result->paginate(12);
  }

  public function getGame($gameId) {
    return $this->gameModel->with('genres')->with('screenshot')->find($gameId);
  }

  public function getNewest() {
    return $this->gameModel->orderBy('updated_at', 'desc')->limit(4)->get();
  }

  public function getBestsellers() {
    return $this->gameModel->orderBy('sold', 'desc')->limit(4)->get();
  }

  public function getPromotions() {
    return $this->gameModel->whereHas('promotions')->orderBy('sold', 'desc')->limit(4)->get();
  }

  public function getComments($gameId) {
    $users = $this->userModel->with(['comments' => function ($query) use ($gameId) {
      $query->where('game_id', $gameId);
    }])->get();

    $comments = [];
    foreach ($users as $user) foreach ($user->comments as $comment) {
      $comments[] = [
        'userId' => $user->id,
        'user' => $user->name,
        'like' => $this->isUserLike($comment->id),
        'likes' => $this->getLikes($comment->id),
        'comment' => $comment->comment,
        'commentId' => $comment->id,
        'created_at' => $comment->created_at->toDateString()
      ];
    }

    array_multisort(array_column($comments, 'likes'), SORT_DESC, $comments);
    $best = $comments;

    array_multisort(array_column($comments, 'created_at'), SORT_DESC, $comments);
    $last = $comments;

    return [
      'best' => array_slice($best, 0, 5),
      'last' => array_slice($last, 0, 5)
    ];
  }

  public function isUserLike($commentId) {
    if (Auth::user()) return $this->userModel->with([
      'likes' => function ($query) use ($commentId) {
        $query->where('users_games_comment_id', $commentId);
      }
    ])->first()->likes->isNotEmpty();
  }

  public function getLikes($commentId) {
    return count($this->userModel->whereHas(
      'likes',
      function ($query) use ($commentId) {
        $query->where('users_games_comment_id', $commentId);
      }
    )->get());
  }

  public function like($commentId) {
    if (Auth::user()) {
      $user = $this->userModel->with([
        'likes' => function ($query) use ($commentId) {
          $query->where('users_games_comment_id', $commentId);
        }
      ])->first();
      if ($user->likes->isEmpty()) $user->likes()->attach(Auth::user()->id, [
        'users_games_comment_id' => $commentId,
        'created_at' => Carbon::now()
      ]);
      else $user->likes()->detach();
      return $user->likes->isEmpty();
    };
  }
}
