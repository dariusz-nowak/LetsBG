<?php

declare(strict_types=1);

namespace App\Repository;

interface LibraryRepository {
  public function getAll();
  public function checkGameStatus($gameId, $status);
  public function getFavorites();
  public function getGame($gameId);
}
