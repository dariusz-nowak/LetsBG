<?php

namespace App\View\Components;

use App\Repository\Library\LibraryRepository;
use Illuminate\View\Component;

class AppLayout extends Component {
  /**
   * Get the view / contents that represents the component.
   *
   * @return \Illuminate\View\View
   */
  private LibraryRepository $libraryRepository;

  public function __construct(LibraryRepository $libraryRepository) {
    $this->libraryRepository = $libraryRepository;
  }

  public function render() {
    return view('layouts.app', [
      'favoriteGames' => $this->libraryRepository->getFavorites(),
    ]);
  }
}
