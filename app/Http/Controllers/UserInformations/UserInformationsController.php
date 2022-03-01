<?php

declare(strict_types=1);

namespace App\Http\Controllers\UserInformations;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserInformations;
use App\Repository\UserInformations\UserInformationsRepository;
use App\Repository\UserSettings\UserSettingsRepository;
use Illuminate\Http\Request;

class UserInformationsController extends Controller {
  private UserInformationsRepository $userInformationsRepository;

  public function __construct(UserInformationsRepository $userInformationsRepository) {
    $this->userInformationsRepository = $userInformationsRepository;
  }
  public function updateUserInformations(UserInformations $userInformations) {
    return $this->userInformationsRepository->saveInformations($userInformations->all());
  }
}
