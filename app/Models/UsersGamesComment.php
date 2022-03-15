<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersGamesComment extends Model {
  protected $fillable = [
    'rating',
    'comment',
  ];
  use HasFactory;
}
