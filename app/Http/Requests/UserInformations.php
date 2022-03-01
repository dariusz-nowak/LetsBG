<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PhoneNumber;

class UserInformations extends FormRequest {
  public function authorize() {
    return true;
  }

  public function rules() {
    return [
      'fname' => 'nullable|string|min:2|max:32',
      'lname' => 'nullable|string|min:2|max:32',
      'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
      'address' => 'nullable|string|max:255',
      'pcode' => 'nullable|min:5|max:9',
      'city' => 'nullable|string|min:2|max:32',
      'country' => 'nullable|string|min:2|max:32',
    ];
  }

  public function messages() {
    return [];
  }
}
