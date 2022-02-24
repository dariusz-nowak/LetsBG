<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class Search extends FormRequest {
  public function authorize() {
    return true;
  }

  public function rules() {
    $userId = Auth::id();

    return [
      'min_price' => 'integer|min:1|nullable',
      'max_price' => 'integer|min:1|nullable',
    ];
  }

  public function messages() {
    return [
      'min_price.integer' => 'Min price must be a number',
      'min_price.min' => 'Min price must be greater than 0',
      'max_price.integer' => 'Max price must be a number',
      'max_price.min' => 'Max price must be greater than 0',
    ];
  }
}
