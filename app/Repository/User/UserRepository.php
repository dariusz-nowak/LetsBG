<?php

declare(strict_types=1);

namespace App\Repository\User;

use App\Models\UsersInformations;
use App\Models\UsersSettings;
use App\Repository\UserRepository as UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface {
  private UsersSettings $userSettingsModel;

  public function __construct(UsersSettings $userSettingsModel, UsersInformations $usersInformations) {
    $this->userSettingsModel = $userSettingsModel;
    $this->usersInformations = $usersInformations;
  }

  public function getSettings() {
    $settings = $this->userSettingsModel->where('user_id', Auth::user()->id)->first();
    return $settings;
  }

  public function getInformations() {
    $informations = $this->usersInformations->where('user_id', Auth::user()->id)->first();
    return $informations;
  }

  public function changeCurrency($currency) {
    return $this->userSettingsModel->where('user_id', Auth::user()->id)->update(['currency' => $currency]);
  }

  public function changeLanguage($language) {
    return $this->userSettingsModel->where('user_id', Auth::user()->id)->update(['language' => $language]);
  }

  public function saveInformations($userInformations) {
    DB::table('users_informations')->where('user_id', Auth::user()->id)->update([
      'first_name' => $userInformations['fname'] ?? null,
      'last_name' => $userInformations['lname'] ?? null,
      'phone' => $userInformations['phone'] ?? null,
      'address' => $userInformations['address'] ?? null,
      'post_code' => $userInformations['pcode'] ?? null,
      'city' => $userInformations['city'] ?? null,
      'country' => $userInformations['country'] ?? null,
    ]);
  }
}
