<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromotionsSeeder extends Seeder {
  public function run() {
    DB::table('promotions')->truncate();

    DB::table('promotions')->insert([
      [
        'id' => 1,
        'name' => 'Promotion March 1 - value',
        'description' => 'March promotion for games ...',
        'value' => 10,
        'percent' => null
      ],
      [
        'id' => 2,
        'name' => 'Promotion March 2 - value',
        'description' => 'March promotion for games ...',
        'value' => 20,
        'percent' => null
      ],
      [
        'id' => 3,
        'name' => 'Promotion March 1 - percent',
        'description' => 'March promotion for games ...',
        'value' => null,
        'percent' => 10
      ],
      [
        'id' => 4,
        'name' => 'Promotion March 2 - percent',
        'description' => 'March promotion for games ...',
        'value' => null,
        'percent' => 20
      ]
    ]);
  }
}
