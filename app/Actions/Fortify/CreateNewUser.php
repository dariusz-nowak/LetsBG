<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers {
  use PasswordValidationRules;

  /**
   * Validate and create a newly registered user.
   *
   * @param  array  $input
   * @return \App\Models\User
   */
  public function create(array $input) {
    $currency = ['USD', 'PLN'];
    Validator::make($input, [
      'name' => ['required', 'string', 'max:255', 'unique:users'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'currency' => ['required', 'min:3', 'max:3', 'in:USD,PLN'],
      'language' => ['required', 'in:english,polish'],
      'password' => $this->passwordRules(),
      'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
    ])->validate();


    $user = User::create([
      'name' => $input['name'],
      'email' => $input['email'],
      'password' => Hash::make($input['password']),
    ]);

    DB::table('users_settings')->insert([
      'user_id' => $user->id,
      'currency' => $input['currency'],
      'language' => $input['language'],
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now()
    ]);

    DB::table('users_informations')->insert([
      'user_id' => $user->id,
      'first_name' => null,
      'last_name' => null,
      'phone' => null,
      'street' => null,
      'house_number' => null,
      'apartment_number' => null,
      'post_code' => null,
      'city' => null,
      'country' => null
    ]);

    return $user;
  }
}
