<?php

declare(strict_types=1);

namespace App\Repository\UserInformations;

use App\Models\UsersInformations;
use App\Repository\UserInformationsRepository as UserInformationsRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserInformationsRepository implements UserInformationsRepositoryInterface {
  private UsersInformations $usersInformations;

  public function __construct(UsersInformations $usersInformations) {
    $this->usersInformations = $usersInformations;
  }

  public function getInformations() {
    $informations = $this->usersInformations->where('user_id', Auth::user()->id)->limit(1)->get();
    return $informations[0];
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

    return redirect()->back();
  }
}
