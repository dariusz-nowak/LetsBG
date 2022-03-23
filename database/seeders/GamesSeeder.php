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
    DB::table('screenshots')->truncate();
    DB::table('pivot_games_genres')->truncate();
    DB::table('pivot_games_producers')->truncate();
    DB::table('pivot_games_promotions')->truncate();
    DB::table('users_games_comments')->truncate();

    $faker = Factory::create();

    $games = $pivotGenres = $pivotProducers = $userGamesComments = [];
    $gamesCount = 50;

    for ($i = 1; $i < $gamesCount + 1; $i++) {
      $langWithpriceCurrency = $faker->randomElement([['english', 'USD'], ['polish', 'PLN']]);
      $games[] = [
        'name' => $faker->words($faker->numberBetween(1, 5), true),
        'description' => $faker->sentence(512, true),
        'short_description' => $faker->sentence(64, true),
        'language' => $langWithpriceCurrency[0],
        'image' => 'https://picsum.photos/seed/picsum/300/300',
        'price' => $faker->randomElement([$faker->randomFloat(2, 10, 200), 0]),
        'price_currency' => $langWithpriceCurrency[1],
        'min_age' => $faker->randomElement([3, 7, 12, 18]) . '+',
        'sold' => $faker->numberBetween(1, 100),
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

      if ($faker->randomElement([1, 2]) == 1) {
        for ($j = 0; $j < $faker->numberBetween(1, 3); $j++) {
          $pivotPromotions[] = [
            'game_id' => $i,
            'promotion_id' => $faker->randomElement([1, 2, 3, 4]),
          ];
        }
      }
      for ($j = 0; $j < $faker->numberBetween(2, 8); $j++) {
        $screenWidth = $faker->randomElement([100, 200, 300]);
        $screenHeight = $faker->randomElement([100, 200, 300]);
        $screenshots[] = [
          'game_id' => $i,
          'thumbnail' => 'https://picsum.photos/seed/picsum/' . $screenWidth  . '/' .  $screenHeight . '',
          'url' => 'https://picsum.photos/seed/picsum/' . $screenWidth * 2 . '/' . $screenHeight * 2 . '',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ];
      }
      $userGamesComments[] = [
        'user_id' => 1,
        'game_id' => $i,
        'rating' => $faker->numberBetween(1, 10),
        'comment' => $faker->words($faker->numberBetween(10, 100), true),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ];
      for ($j = 0; $j < $faker->numberBetween(10, 40); $j++) {
        $userGamesComments[] = [
          'user_id' => $faker->numberBetween(2, 301),
          'game_id' => $i,
          'rating' => $faker->numberBetween(1, 5),
          'comment' => $faker->words($faker->numberBetween(10, 100), true),
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ];
      }
    }

    DB::table('games')->insert($games);
    DB::table('screenshots')->insert($screenshots);
    DB::table('pivot_games_genres')->insert($pivotGenres);
    DB::table('pivot_games_producers')->insert($pivotProducers);
    DB::table('pivot_games_promotions')->insert($pivotPromotions);
    DB::table('users_games_comments')->insert($userGamesComments);
  }
}
