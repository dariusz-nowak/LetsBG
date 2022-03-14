<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    DB::table('users')->truncate();
    DB::table('users_settings')->truncate();
    DB::table('users_informations')->truncate();
    DB::table('pivot_users_games')->truncate();

    $faker = Factory::create();

    DB::table('users')->insert([
      'id' => 1,
      'name' => 'Dariusz',
      'email' => 'nowak.dariusz.90@gmail.com',
      'email_verified_at' => null,
      'password' => '$2y$10$/PBXOrsWGaIqP52FSaEh8uZw5ZsA8i8jWNM18rLyjBYiiwJDKa8v.',
      'two_factor_secret' => null,
      'two_factor_recovery_codes' => null,
      'remember_token' => null,
      'current_team_id' => null,
      'profile_photo_path' => null,
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
    ]);

    DB::table('users_settings')->insert([
      'user_id' => 1,
      'currency' => 'USD',
      'language' => 'english',
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now()
    ]);

    DB::table('users_informations')->insert([
      'user_id' => 1,
      'first_name' => 'Dariusz',
      'last_name' => 'Nowak',
      'phone' => '788660097',
      'address' => 'ul. Anny Jasinskiej 7/1a',
      'post_code' => '54-330',
      'city' => 'Wroclaw',
      'country' => 'Polska'
    ]);

    $users = $pivotGames = [];
    $gamesCount = 50;

    for ($i = 0; $i < 4; $i++) {
      $users[] = [
        'name' => $faker->words($faker->numberBetween(1, 5), true),
        'email' => $faker->email(),
        'email_verified_at' => null,
        'password' => 'xxx',
        'two_factor_secret' => null,
        'two_factor_recovery_codes' => null,
        'remember_token' => null,
        'current_team_id' => null,
        'profile_photo_path' => null,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ];
    }

    for ($i = 1; $i < count($users) + 1; $i++) {
      for ($j = 1; $j < $gamesCount; $j++) {
        $randomBoolean = $faker->boolean();
        $pivotGames[] = [
          'user_id' => $i,
          'game_id' => $j,
          'favorite' => $faker->randomElement([$randomBoolean, 0]),
          'hidden' => !$randomBoolean
        ];
      }
    }

    DB::table('pivot_users_games')->insert($pivotGames);
    DB::table('users')->insert($users);
  }
}
