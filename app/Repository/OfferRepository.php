<?php

declare(strict_types=1);

namespace App\Repository;

interface OfferRepository {
  public function getAll($user);
  public function search($user, $categories, $languages, $ages, $producers, $request);
  public function getGame($gameId);
  public function getNewest();
  public function getBestsellers();
  public function getPromotions();
}
