<?php

declare(strict_types=1);

namespace App\Repository;

interface OfferRepository {
  public function getAll($user, $language);
  public function search($user, $categories, $languages, $ages, $producers, $request);
  public function getGame($gameId);
  public function getComments($gameId, $sort, $page);
  public function getLikes($commentId);
  public function isUserLike($commentId);
  public function like($commentId);
  public function getNewest();
  public function getBestsellers();
  public function getPromotions();
}
