<?php

declare(strict_types=1);

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class Homepage extends Controller {
  public function load() {
    return view('homepage', []);
  }
  public function redirect() {
    return redirect('/');
  }
}
