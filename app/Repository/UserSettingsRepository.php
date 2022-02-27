<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\UserSettings;

interface UserSettingsRepository {
  public function getSettings();
  public function changeCurrency($currency);
}
