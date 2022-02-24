<?php

namespace App\Http\Middleware;

use App\Repository\Offer\OfferRepository;
use Closure;
use Illuminate\Http\Request;

class CheckGameExists {
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */

  private OfferRepository $offerRepository;

  public function __construct(OfferRepository $offerRepository) {
    $this->offerRepository = $offerRepository;
  }

  public function handle(Request $request, Closure $next) {
    if (!$this->offerRepository->getGame($request->route()->parameter('game'))) return redirect('/');
    else return $next($request);
  }
}
