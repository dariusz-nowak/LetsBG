<?php

use App\Http\Controllers\Game\GameController;
use App\Http\Controllers\Offer\OfferController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Home\Homepage;
use App\Http\Controllers\Library\LibraryController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\CheckGameExists;
use App\Http\Middleware\CheckUserHaveGame;
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

Route::get('/', [Homepage::class, 'load'])->name('homepage');

// Oferta
Route::group([
  'prefix' => 'offer', // ścieżka początkowa do przekierowania
  'as' => 'offer.' // ścieżka początkowa do nazwy
], function () {
  Route::get('', [OfferController::class, 'show'])->name('offer');
  Route::get('search', [OfferController::class, 'search'])->name('search');
  Route::get('{game}', [OfferController::class, 'gameDetails'])
    ->middleware(CheckGameExists::class)->name('game');
});

// Biblioteka
Route::group([
  'middleware' => 'auth',
  'prefix' => 'library',
  'as' => 'library.'
], function () {
  Route::get('', [LibraryController::class, 'show'])->name('show');
});

// Koszyk
Route::group([
  'middleware' => 'auth',
  'prefix' => 'cart',
  'as' => 'cart.',
], function () {
  Route::get('', [CartController::class, 'show'])->name('show');
  Route::post('add', [CartController::class, 'add'])->name('add');
  Route::post('update', [CartController::class, 'update'])->name('update');
  Route::post('remove', [CartController::class, 'remove'])->name('remove');
  Route::post('clear', [CartController::class, 'clear'])->name('clear');
});

// Gry
Route::group([
  'middleware' => 'auth',
  'as' => 'game.'
], function () {
  Route::post('{game}', [GameController::class, 'add'])->name('add');
  Route::get('{game}/lobby', [GameController::class, 'lobby'])
    ->middleware(CheckGameExists::class)
    ->middleware(CheckUserHaveGame::class)->name('lobby');
});

// Zabezpieczenia
Route::get('{whatever}', [Homepage::class, 'redirect']);
Route::get('library/{whatever}', [Homepage::class, 'redirect']);
Route::get('cart/{whatever}', [Homepage::class, 'redirect']);
Route::get('game/{whatever}', [Homepage::class, 'redirect']);

// Testy
