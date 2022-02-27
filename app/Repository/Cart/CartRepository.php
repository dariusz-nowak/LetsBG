<?php

declare(strict_types=1);

namespace App\Repository\Cart;

use App\Models\Game;
use App\Repository\CartRepository as CartRepositoryInterface;

class CartRepository implements CartRepositoryInterface {

  private Game $gameModel;

  public function __construct(Game $gameModel) {
    $this->gameModel = $gameModel;
  }

  public function show() {
    if (session('cartItems')) return $this->gameModel->whereIn('id', session('cartItems'))->get();
  }

  public function add($gameId) {
    $cartItemsSession = session('cartItems') ?? [];
    if (empty($cartItemsSession)) session()->put('cartItems', []);
    if (!in_array($gameId, $cartItemsSession)) session()->push('cartItems', $gameId);
    return redirect()->back();
  }
  public function remove($gameId) {
    $cartItemsSession = session('cartItems') ?? [];
    if (in_array($gameId, $cartItemsSession)) $cartItemsSession = array_diff($cartItemsSession, [$gameId]);
    session(['cartItems' => $cartItemsSession]);
    return redirect()->back();
  }
  public function clear() {
    session()->forget('cartItems');
    return redirect()->back();
  }
}
