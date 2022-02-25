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

    $pivotGames = [];
    $gamesCount = 50;

    for ($i = 1; $i < $gamesCount + 1; $i++) {
      for ($j = 1; $j < $faker->numberBetween(1, 16); $j++) {
        $randomBoolean = $faker->boolean();
        $pivotGames[] = [
          'user_id' => $i,
          'game_id' => $faker->numberBetween(1, 50),
          'favorite' => $randomBoolean,
          'hidden' => !$randomBoolean
        ];
      }
    }

    DB::table('pivot_users_games')->insert($pivotGames);
  }
}
