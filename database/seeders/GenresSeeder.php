<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenresSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    DB::table('genres')->truncate();

    $faker = Factory::create();

    $games = [];
    $gamesCount = 5;

    for ($i = 0; $i < $gamesCount; $i++) {
      $games[] = [
        'name' => $faker->word(),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ];
    }
    DB::table('genres')->insert($games);
  }
}
