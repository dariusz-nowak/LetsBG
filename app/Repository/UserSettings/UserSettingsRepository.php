<?php

declare(strict_types=1);

namespace App\Repository\UserSettings;

use App\Models\UsersSettings;
use App\Repository\UserSettingsRepository as UserSettingsRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UserSettingsRepository implements UserSettingsRepositoryInterface {
  private UsersSettings $userSettingsModel;

  public function __construct(UsersSettings $userSettingsModel) {
    $this->userSettingsModel = $userSettingsModel;
  }

  public function getSettings() {
    $settings = $this->userSettingsModel->where('user_id', Auth::user()->id)->limit(1)->get();
    return $settings[0];
  }

  public function changeCurrency($currency) {
    $this->userSettingsModel->where('user_id', Auth::user()->id)->update(['currency' => $currency]);
    return redirect()->back();
  }
}
