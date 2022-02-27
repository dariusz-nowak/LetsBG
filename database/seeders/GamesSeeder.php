<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GamesSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    DB::table('games')->truncate();
    DB::table('pivot_games_genres')->truncate();
    DB::table('pivot_games_producers')->truncate();

    $faker = Factory::create();

    $games = [];
    $pivotGenres = [];
    $pivotProducers = [];
    $gamesCount = 50;

    for ($i = 1; $i < $gamesCount + 1; $i++) {
      $langWithpriceCurrency = $faker->randomElement([['english', 'USD'], ['polish', 'PLN']]);
      $games[] = [
        'name' => $faker->words($faker->numberBetween(1, 3), true),
        'description' => $faker->sentence(64, true),
        'short_description' => $faker->sentence(16, true),
        'language' => $langWithpriceCurrency[0],
        'image' => 'https://picsum.photos/seed/picsum/300/300',
        'price' => $faker->randomElement([$faker->randomFloat(2, 10, 200), 0]),
        'price_currency' => $langWithpriceCurrency[1],
        'min_age' => $faker->randomElement([3, 7, 12, 18]) . '+',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ];

      for ($j = 0; $j < $faker->numberBetween(1, 3); $j++) {
        $pivotGenres[] = [
          'game_id' => $i,
          'genre_id' => $faker->numberBetween(1, 5),
        ];
      }

      $pivotProducers[] = [
        'game_id' => $i,
        'producer_id' => $faker->numberBetween(1, 5),
      ];
    }

    DB::table('games')->insert($games);
    DB::table('pivot_games_genres')->insert($pivotGenres);
    DB::table('pivot_games_producers')->insert($pivotProducers);
  }
}
