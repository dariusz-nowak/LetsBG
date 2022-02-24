<?php

declare(strict_types=1);

namespace App\Repository;

interface LibraryRepository {
  public function getAll();
  public function add($gameId);
}
