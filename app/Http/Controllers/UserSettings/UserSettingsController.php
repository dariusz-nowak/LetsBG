<?php

declare(strict_types=1);

namespace App\Http\Controllers\UserSettings;

use App\Http\Controllers\Controller;
use App\Repository\UserSettings\UserSettingsRepository;

class UserSettingsController extends Controller {
  private UserSettingsRepository $userSettingsRepository;
  public function __construct(UserSettingsRepository $userSettingsRepository) {
    $this->userSettingsRepository = $userSettingsRepository;
  }
  public function changeCurrency($currency) {
    return $this->userSettingsRepository->changeCurrency($currency);
  }
  public function updateUserInformations() {
    // 'fname' => ['nullable', 'string', 'max:255'],
    // 'lname' => ['nullable', 'string', 'max:255'],
    // 'phone' => ['nullable', 'integer', 'max:255'],
    // 'street' => ['nullable', 'string', 'max:255'],
    // 'hnum' => ['nullable', 'string', 'max:255'],
    // 'anum' => ['nullable', 'string', 'max:255'],
    // 'pcode' => ['nullable', 'string', 'max:255'],
    // 'city' => ['nullable', 'string', 'max:255'],
    // 'country' => ['nullable', 'string', 'max:255'],

    // DB::table('users_informations')->where('user_id', $user->id)->update([
    //   'first_name' => $input['fname'] ?? null,
    //   'last_name' => $input['lname'] ?? null,
    //   'phone' => $input['phone'] ?? null,
    //   'street' => $input['street'] ?? null,
    //   'house_number' => $input['hnum'] ?? null,
    //   'apartment_number' => $input['anum'] ?? null,
    //   'post_code' => $input['pcode'] ?? null,
    //   'city' => $input['city'] ?? null,
    //   'country' => $input['country'] ?? null,
    // ]);
    return redirect()->back();
  }
}
