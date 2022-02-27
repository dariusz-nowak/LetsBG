<?php

declare(strict_types=1);

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Repository\Cart\CartRepository;

class CartController extends Controller {
  private CartRepository $cartRepository;

  public function __construct(CartRepository $cartRepository) {
    $this->cartRepository = $cartRepository;
  }

  public function show() {
    return view('cart.main', [
      'products' => $this->cartRepository->show(),
    ]);
  }

  public function add($gameId) {
    return $this->cartRepository->add($gameId);
  }

  public function remove($gameId) {
    return $this->cartRepository->remove($gameId);
  }

  public function clear() {
    return $this->cartRepository->clear();
  }
}
