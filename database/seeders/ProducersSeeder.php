<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProducersSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    DB::table('producers')->truncate();

    $faker = Factory::create();

    $producers = [];
    $producersCount = 5;

    for ($i = 0; $i < $producersCount; $i++) {
      $producers[] = [
        'name' => $faker->word(),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ];
    }
    DB::table('producers')->insert($producers);
  }
}
