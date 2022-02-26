<?php

declare(strict_types=1);

namespace App\Repository\Offer;

use App\Models\Game;
use App\Repository\OfferRepository as OfferRepositoryInterface;

class OfferRepository implements OfferRepositoryInterface {

  private Game $gameModel;

  public function __construct(Game $gameModel) {
    $this->gameModel = $gameModel;
  }

  public function getAll($user) {
    $query = $this->gameModel->with('genres')->with('producers');

    if ($user) $query = $query->with('users')->whereDoesntHave('users', function ($query) use ($user) {
      $query->where('user_id', $user->id);
    });

    return $query->paginate(12);
  }

  public function search($user, $owned, $phrase, $sort, $categories, $languages, $ages, $producers, $free_only, $min_price, $max_price) {

    $result = $this->gameModel->with('genres')->with('producers')->with('users');

    if (empty($owned) && $user) $result = $result->whereDoesntHave('users', function ($query) use ($user) {
      $query->where('user_id', $user->id);
    });

    if (!empty($phrase)) $result = $result->where(function ($query) use ($phrase) {
      $query->orWhere('name', 'like', '%' . $phrase . '%')
        ->orWhere('description', 'like', '%' . $phrase . '%')
        ->orWhere('short_description', 'like', '%' . $phrase . '%');
    });

    if (!empty($categories)) $result = $result->whereHas('genres', function ($query) use ($categories) {
      $query->whereIn('name', $categories);
    });

    if (!empty($producers)) $result = $result->whereHas('producers', function ($query) use ($producers) {
      $query->whereIn('name', $producers);
    });

    if (!empty($languages)) $result = $result->whereIn('language', $languages);
    if (!empty($ages)) $result = $result->whereIn('min_age', $ages);

    if (empty($free_only)) {
      if (!empty($min_price)) $result->where('price', '>=', $min_price);
      if (!empty($max_price)) $result->where('price', '<=', $max_price);
    } else $result->where('price', 0);

    if (!empty($sort)) {
      if ($sort === 'nameAsc') $result->orderBy('name', 'asc');
      else if ($sort === 'nameDesc') $result->orderBy('name', 'desc');
      else if ($sort === 'priceAsc') $result->orderBy('price', 'asc');
      else if ($sort === 'priceDesc') $result->orderBy('price', 'desc');
    }

    return $result->paginate(12);
  }

  public function getGame($gameId) {
    return $this->gameModel->with('genres')
      ->find($gameId);
  }
}
