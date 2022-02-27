<?php

use App\Http\Controllers\Game\GameController;
use App\Http\Controllers\Offer\OfferController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Home\Homepage;
use App\Http\Controllers\Library\LibraryController;
use App\Http\Controllers\UserSettings\UserSettings;
use App\Http\Middleware\CheckGameExists;
use App\Http\Middleware\CheckGameStatus;
use App\Http\Middleware\CheckUserHaveGame;
use App\Http\Middleware\ViewShareMiddleware;
use GuzzleHttp\Middleware;
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

// Auth::user();
Route::group(['middleware' => ViewShareMiddleware::class], function () {
  Route::get('/', [Homepage::class, 'load'])->name('homepage');

  // Oferta
  Route::group([
    'prefix' => 'offer', // ścieżka początkowa do przekierowania
    'as' => 'offer.' // ścieżka początkowa do nazwy
  ], function () {
    Route::get('', [OfferController::class, 'show'])->name('show');
    Route::get('search', [OfferController::class, 'search'])->name('search');
    Route::get('{game}', [OfferController::class, 'gameDetails'])
      ->middleware(CheckGameExists::class)->name('gameDetails');
  });

  // Biblioteka
  Route::group([
    'middleware' => 'auth',
    'prefix' => 'library',
    'as' => 'library.'
  ], function () {
    Route::get('', [LibraryController::class, 'show'])->name('show');
    Route::post('{game}/{status}', [LibraryController::class, 'checkGameStatus'])
      ->middleware(CheckGameStatus::class)
      ->middleware(CheckGameExists::class)
      ->middleware(CheckUserHaveGame::class)->name('checkGameStatus');
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
    Route::post('changeCurrency', [UserSettings::class, 'changeCurrency'])->name('changeCurrency');
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
