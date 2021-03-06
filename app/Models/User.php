<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
  use HasApiTokens;
  use HasFactory;
  use HasProfilePhoto;
  use Notifiable;
  use TwoFactorAuthenticatable;

  /**
   * The attributes that are mass assignable.
   *
   * @var string[]
   */
  protected $fillable = [
    'name',
    'email',
    'password',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array
   */
  protected $hidden = [
    'password',
    'remember_token',
    'two_factor_recovery_codes',
    'two_factor_secret',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  /**
   * The accessors to append to the model's array form.
   *
   * @var array
   */
  protected $appends = [
    'profile_photo_url',
  ];

  public function games() {
    return $this->belongsToMany('App\Models\Game', 'pivot_users_games');
  }

  public function usersSettings() {
    return $this->hasOne('App\Models\UserSettings', 'used_id');
  }

  public function usersInformations() {
    return $this->hasOne('App\Models\UsersInformations', 'used_id');
  }

  public function rates() {
    return $this->hasMany('App\Models\UsersGamesComment', 'user_id');
  }

  public function comments() {
    return $this->hasMany('App\Models\UsersGamesComment', 'user_id');
  }

  public function likes() {
    return $this->belongsToMany('App\Models\UsersGamesComment', 'pivot_users_likes');
  }
}
