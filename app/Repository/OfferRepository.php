<?php

declare(strict_types=1);

namespace App\Repository;

interface OfferRepository {
  public function getAll($user, $language);
  public function search($user, $categories, $languages, $ages, $producers, $request);
  public function getGame($gameId);
  public function getComments($gameId);
  public function getLikes($commentId);
  public function isUserLike($commentId);
  public function isLikeComment($commentId);
  public function getNewest();
  public function getBestsellers();
  public function getPromotions();
}
