<?php

declare(strict_types=1);

namespace App\Repository\User;

use App\Models\UsersInformations;
use App\Models\UsersSettings;
use App\Repository\UserRepository as UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface {
  private UsersSettings $userSettingsModel;
  private UsersInformations $usersInformationsModel;

  public function __construct(UsersSettings $userSettingsModel, UsersInformations $usersInformationsModel) {
    $this->userSettingsModel = $userSettingsModel;
    $this->usersInformationsModel = $usersInformationsModel;
  }

  public function getSettings() {
    return $this->userSettingsModel->where('user_id', Auth::user()->id)->first();
  }

  public function getInformations() {
    return $this->usersInformationsModel->where('user_id', Auth::user()->id)->first();
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
