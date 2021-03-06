<?php

use App\Http\Controllers\Game\GameController;
use App\Http\Controllers\Offer\OfferController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Home\Homepage;
use App\Http\Controllers\Library\LibraryController;
use App\Http\Controllers\User\UserController;
use App\Http\Middleware\CheckGameExists;
use App\Http\Middleware\CheckGameStatus;
use App\Http\Middleware\CheckUserHaveGame;
use App\Http\Middleware\ViewShareMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ViewShareMiddleware::class], function () {
  Route::get('/', [Homepage::class, 'load'])->name('homepage');

  // Dynamiczne wczytywanie treści
  Route::group([
    'prefix' => 'load', // ścieżka początkowa do przekierowania
    'as' => 'load.' // ścieżka początkowa do nazwy
  ], function () {
    Route::get('bestsellers', [Homepage::class, 'loadBestsellers'])->name('bestsellers');
    Route::get('promotions', [Homepage::class, 'loadPromotions'])->name('promotions');
    Route::get('comments/{gameId}', [Homepage::class, 'loadComments'])->name('comments');
  });

  // Oferta
  Route::group([
    'prefix' => 'offer', // ścieżka początkowa do przekierowania
    'as' => 'offer.' // ścieżka początkowa do nazwy
  ], function () {
    Route::get('show', [OfferController::class, 'show'])->name('show');
    Route::get('search', [OfferController::class, 'search'])->name('search');
    Route::get('{game}', [OfferController::class, 'gameDetails'])
      ->middleware(CheckGameExists::class)->name('gameDetails');
    Route::get('like/{commentId}', [OfferController::class, 'like'])->name('like');
  });

  // Biblioteka
  Route::group([
    'middleware' => 'auth',
    'prefix' => 'library',
    'as' => 'library.'
  ], function () {
    Route::get('', [LibraryController::class, 'show'])->name('show');
    Route::get('favorites', [LibraryController::class, 'favorites'])->name('favorites');
    Route::get('loadGameDetails/{game}', [LibraryController::class, 'loadGameDetails'])->name('loadGameDetails');
    Route::post('{game}/{status}', [LibraryController::class, 'checkGameStatus'])
      ->middleware(CheckGameStatus::class)
      ->middleware(CheckGameExists::class)
      ->middleware(CheckUserHaveGame::class)
      ->name('checkGameStatus');
    Route::post('rate', [LibraryController::class, 'rate'])->name('rate');
    Route::post('comment', [LibraryController::class, 'comment'])->name('comment');
  });

  // Koszyk
  Route::group([
    'middleware' => 'auth',
    'prefix' => 'cart',
    'as' => 'cart.',
  ], function () {
    Route::get('', [CartController::class, 'show'])->name('show');
    Route::post('add/{game}', [CartController::class, 'add'])->name('add');
    Route::post('remove/{game}', [CartController::class, 'remove'])->name('remove');
    Route::post('clear', [CartController::class, 'clear'])->name('clear');
  });

  // Ustawawienia
  Route::group([
    'middleware' => 'auth',
    'prefix' => 'settings',
    'as' => 'settings.'
  ], function () {
    Route::post('changeCurrency/{currency}', [UserController::class, 'changeCurrency'])->name('changeCurrency');
    Route::post('changeLanguage/{language}', [UserController::class, 'changeLanguage'])->name('changeLanguage');
    Route::post('updateUserInformations', [UserController::class, 'updateUserInformations'])->name('updateUserInformations');
  });

  // Gry
  Route::group([
    'middleware' => 'auth',
    'as' => 'game.'
  ], function () {
    Route::get('{game}/lobby', [GameController::class, 'lobby'])
      ->middleware(CheckGameExists::class)
      ->middleware(CheckUserHaveGame::class)->name('lobby');
    Route::post('{game}', [GameController::class, 'add'])->name('add');
  });

  // Zabezpieczenia
  Route::get('{whatever}', [Homepage::class, 'redirect']);
  Route::get('library/{whatever}', [Homepage::class, 'redirect']);
  Route::get('cart/{whatever}', [Homepage::class, 'redirect']);
  Route::get('game/{whatever}', [Homepage::class, 'redirect']);
});
