<?php

declare(strict_types=1);

namespace App\Http\Controllers\UserSettings;

use App\Http\Controllers\Controller;
use App\Repository\UserSettings\UserSettingsRepository;

class UserSettings extends Controller {
  private UserSettingsRepository $userSettingsRepository;
  public function __construct(UserSettingsRepository $userSettingsRepository) {
    $this->userSettingsRepository = $userSettingsRepository;
  }
  public function changeCurrency($currency) {
    return $this->userSettingsRepository->changeCurrency($currency);
  }
}
