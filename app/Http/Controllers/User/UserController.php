<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserInformations;
use App\Repository\User\UserRepository;

class UserController extends Controller {
  private UserRepository $userRepository;

  public function __construct(UserRepository $userRepository) {
    $this->userRepository = $userRepository;
  }
  public function changeCurrency($currency) {
    $this->userRepository->changeCurrency($currency);
    return redirect()->back();
  }
  public function changeLanguage($language) {
    $this->userRepository->changeLanguage($language);
    return redirect()->back();
  }
  public function updateUserInformations(UserInformations $userInformations) {
    $this->userRepository->saveInformations($userInformations->all());
    $this->userRepository->changeCurrency($userInformations->currency);
    return redirect()->back();
  }
}
