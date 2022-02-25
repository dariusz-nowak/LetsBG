<?php

declare(strict_types=1);

namespace App\Http\Controllers\Offer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Search;
use App\Repository\Genre\GenreRepository;
use App\Repository\Library\LibraryRepository;
use App\Repository\Offer\OfferRepository;
use App\Repository\Producers\ProducersRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller {

  private OfferRepository $offerRepository;
  private GenreRepository $genreRepository;
  private ProducersRepository $producersRepository;
  private LibraryRepository $libraryRepository;

  public function __construct(OfferRepository $offerRepository, GenreRepository $genreRepository, ProducersRepository $producersRepository, LibraryRepository $libraryRepository) {
    $this->offerRepository = $offerRepository;
    $this->genreRepository = $genreRepository;
    $this->producersRepository = $producersRepository;
    $this->libraryRepository = $libraryRepository;
  }

  public function show(): View {
    return view('offer.main', [
      'games' => $this->offerRepository->getAll(Auth::user()),
      'genres' => $this->genreRepository->getAll(),
      'producers' => $this->producersRepository->getAll(),
      'favoriteGames' => $this->libraryRepository->getAll(),
    ]);
  }

  public function search(Request $request): View {

    $categories = $languages = $ages = $producers = [];
    foreach ($request->all() as $property => $filter) {
      if ($filter === 'category') array_push($categories, $property);
      else if ($filter === 'language') array_push($languages, $property);
      else if ($filter === 'age') array_push($ages, $property);
      else if ($filter === 'producer') array_push($producers, $property);
    }

    $gamesWithPaginator = $this->offerRepository->search(Auth::user(), $request->owned, $request->phrase, $request->sort, $categories, $languages, $ages, $producers, $request->free_only, $request->min_price, $request->max_price);

    $FiltersToAppend = [];
    $FiltersToAppend['sort'] = $request->sort;
    $FiltersToAppend['phrase'] = $request->phrase;
    $FiltersToAppend['free_only'] = $request->free_only;
    $FiltersToAppend['min_price'] = $request->min_price;
    $FiltersToAppend['max_price'] = $request->max_price;
    $FiltersToAppend['owned'] = $request->owned;

    foreach ($categories as $category) $FiltersToAppend[$category] = 'category';
    foreach ($languages as $language) $FiltersToAppend[$language] = 'language';
    foreach ($producers as $producer) $FiltersToAppend[$producer] = 'producer';
    foreach ($ages as $age) $FiltersToAppend[$age] = 'age';

    $gamesWithPaginator->appends($FiltersToAppend);

    return view('offer.main', [
      'games' => $gamesWithPaginator,
      'genres' => $this->genreRepository->getAll(),
      'producers' => $this->producersRepository->getAll(),
      'request' => $request->all(),
      'favoriteGames' => $this->libraryRepository->getFavorites()
    ]);
  }
  public function gameDetails($gameId) {
    return view('offer.game', [
      'game' => $this->offerRepository->getGame($gameId),
      'favoriteGames' => $this->libraryRepository->getFavorites(),
    ]);
  }
}
