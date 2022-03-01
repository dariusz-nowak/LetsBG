<?php

declare(strict_types=1);

namespace App\Repository;

interface UserSettingsRepository {
  public function getSettings();
  public function changeCurrency($currency);
}
