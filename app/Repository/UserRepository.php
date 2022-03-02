<?php

declare(strict_types=1);

namespace App\Repository;

interface UserRepository {
  public function getSettings();
  public function getInformations();
  public function changeCurrency($currency);
  public function changeLanguage($language);
  public function saveInformations($userInformations);
}
