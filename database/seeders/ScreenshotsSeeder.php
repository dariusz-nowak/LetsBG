<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScreenshotsSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    DB::table('screenshots')->truncate();

    $screenshots = [[
      'game_id' => '1',
      'thumbnail' => 'https://picsum.photos/seed/picsum/100/100',
      'url' => 'https://picsum.photos/seed/picsum/300/300',
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
    ], [
      'game_id' => '1',
      'thumbnail' => 'https://picsum.photos/seed/picsum/110/100',
      'url' => 'https://picsum.photos/seed/picsum/310/300',
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
    ], [
      'game_id' => '1',
      'thumbnail' => 'https://picsum.photos/seed/picsum/120/100',
      'url' => 'https://picsum.photos/seed/picsum/320/300',
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
    ], [
      'game_id' => '1',
      'thumbnail' => 'https://picsum.photos/seed/picsum/130/100',
      'url' => 'https://picsum.photos/seed/picsum/330/300',
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
    ]];

    DB::table('screenshots')->insert($screenshots);
  }
}
