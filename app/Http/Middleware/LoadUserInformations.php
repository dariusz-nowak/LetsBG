<?php

namespace App\Http\Middleware;

use App\Repository\User\UserRepository;
use Closure;
use Illuminate\Http\Request;

class LoadUserInformations {
  private UserRepository $userRepository;

  public function __construct(UserRepository $userRepository) {
    $this->userRepository = $userRepository;
  }
  public function handle(Request $request, Closure $next) {
    view()->share('userInformations', $this->userRepository->getInformations());
    return $next($request);
  }
}
