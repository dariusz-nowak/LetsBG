<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersGamesRating extends Model {
  protected $fillable = [
    'rating',
    'comment',
  ];
  use HasFactory;
}
