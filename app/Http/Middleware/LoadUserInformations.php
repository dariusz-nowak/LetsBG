<?php

namespace App\Http\Middleware;

use App\Repository\UserInformations\UserInformationsRepository;
use Closure;
use Illuminate\Http\Request;

class LoadUserInformations {
  private UserInformationsRepository $userInformationsRepository;

  public function __construct(UserInformationsRepository $userInformationsRepository) {
    $this->userInformationsRepository = $userInformationsRepository;
  }
  public function handle(Request $request, Closure $next) {
    view()->share('userInformations', $this->userInformationsRepository->getInformations());
    return $next($request);
  }
}
