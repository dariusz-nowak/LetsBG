<?php

declare(strict_types=1);

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Repository\Library\LibraryRepository;

class LibraryController extends Controller {

  private LibraryRepository $libraryRepository;

  public function __construct(LibraryRepository $libraryRepository,) {
    $this->libraryRepository = $libraryRepository;
  }
  public function show() {
    return view('library.main', [
      'games' => $this->libraryRepository->getAll(),
    ]);
  }
  public function checkGameStatus($gameId) {
    dd($gameId);
    return view('library.main', [
      'games' => $this->libraryRepository->getAll(),
    ]);
  }
}
