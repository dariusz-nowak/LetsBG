<?php

declare(strict_types=1);

namespace App\Repository;

interface UserInformationsRepository {
  public function getInformations();
  public function saveInformations($userInformations);
}
