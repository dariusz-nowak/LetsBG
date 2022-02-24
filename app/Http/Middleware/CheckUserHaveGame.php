<?php

namespace App\Http\Middleware;

use App\Repository\Library\LibraryRepository;
use Closure;
use Illuminate\Http\Request;

class CheckUserHaveGame {
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */

  private LibraryRepository $libraryRepository;

  public function __construct(LibraryRepository $libraryRepository) {
    $this->libraryRepository = $libraryRepository;
  }

  public function handle(Request $request, Closure $next) {
    $games = [];
    foreach ($this->libraryRepository->getAll() as $game) $games[] = $game->id;
    if (!in_array($request->route()->parameter('game'), $games)) return redirect('/offer/' . $request->route()->parameter('game'));
    else return $next($request);
  }
}
