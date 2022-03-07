<?php

declare(strict_types=1);

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Repository\Library\LibraryRepository;
use App\Repository\Offer\OfferRepository;

class Homepage extends Controller {

  private LibraryRepository $libraryRepository;
  private OfferRepository $offerRepository;

  public function __construct(LibraryRepository $libraryRepository, OfferRepository $offerRepository) {
    $this->libraryRepository = $libraryRepository;
    $this->offerRepository = $offerRepository;
  }

  public function load() {
    return view('homepage', [
      'newGames' => $this->offerRepository->getNewest(),
    ]);
  }

  public function loadBestsellers() {
    return view('shared.load.bestsellers', [
      'bestsellers' => $this->offerRepository->getBestsellers(),
    ]);
  }


  public function loadPromotions() {
    return view('shared.load.promotions', [
      'promotionGames' => $this->offerRepository->getPromotions(),
    ]);
  }

  public function redirect() {
    return redirect('/');
  }
}
