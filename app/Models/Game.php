<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model {
  protected $fillable = [
    'user_id', 'game_id'
  ];

  public function screenshot() {
    return $this->hasMany('App\Models\Screenshot', 'game_id');
  }
  public function genres() {
    return $this->belongsToMany('App\Models\Genre', 'pivot_games_genres');
  }
  public function producers() {
    return $this->belongsToMany('App\Models\Producer', 'pivot_games_producers');
  }
  public function promotions() {
    return $this->belongsToMany('App\Models\Promotion', 'pivot_games_promotions');
  }
  public function users() {
    return $this->belongsToMany('App\Models\User', 'pivot_users_games')->withPivot('favorite', 'hidden');
  }
}
