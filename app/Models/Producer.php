<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producer extends Model {
  public function games() {
    return $this->belongsToMany('App\Models\Game', 'pivot_games_producers');
  }
}
