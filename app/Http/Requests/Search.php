<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Search extends FormRequest {
  public function authorize() {
    return true;
  }

  public function rules() {
    return [
      'phrase' => 'min:3|max:255|nullable',
      'min_price' => 'integer|min:1|nullable',
      'max_price' => 'integer|min:1|nullable',
    ];
  }

  public function messages() {
    return [
      'phrase.min' => 'Phrase must be longer than 2 characters',
      'phrase.max' => 'Phrase must be shorter than 2 characters',
      'min_price.integer' => 'Min price must be a number',
      'min_price.min' => 'Min price must be greater than 0',
      'max_price.integer' => 'Max price must be a number',
      'max_price.min' => 'Max price must be greater than 0',
    ];
  }
}
