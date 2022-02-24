<?php

declare(strict_types=1);

namespace App\Repository;

interface OfferRepository {
  public function getAll($user);
  public function search($user, $owned, $phrase, $sort, $categories, $languages, $ages, $producers, $freeOnly, $min_price, $max_price);
  public function getGame($gameId);
}
