<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsSeeder extends Seeder {
  public function run() {
    DB::table('pivot_users_likes')->truncate();

    $faker = Factory::create();

    $gamesCount = 50;
    $usersCount = 50;
    $commentsCount = 15;

    for ($i = 0; $i < $gamesCount; $i++) {
      for ($j = 0; $j < $commentsCount; $j++) {
        $pivotUsers[] = [
          'user_id' => $faker->numberBetween(1, $usersCount),
          'comment_id' => $faker->numberBetween(1, 200),
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ];
      }
    }
    DB::table('pivot_users_likes')->insert($pivotUsers);
  }
}
