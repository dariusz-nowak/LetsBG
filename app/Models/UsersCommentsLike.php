<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersCommentsLike extends Model {
  protected $fillable = [
    'like'
  ];
  use HasFactory;
}
