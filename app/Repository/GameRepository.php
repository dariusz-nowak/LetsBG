<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Game;

interface GameRepository {
  public function getGame($gameId);
  public function add(Game $game);
}
