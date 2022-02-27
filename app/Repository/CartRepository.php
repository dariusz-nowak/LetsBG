<?php

declare(strict_types=1);

namespace App\Repository;

interface CartRepository {
  public function show();
  public function add($gameId);
  public function remove($gameId);
  public function clear();
}
