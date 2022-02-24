<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('Genres', function (Blueprint $table) {
      $table->id();
      $table->string('name', 64);
      $table->timestamps();
    });

    Schema::create('Pivot_Games_Genres', function (Blueprint $table) {
      $table->integer('game_id')->index();
      $table->integer('genre_id')->index();

      $table->index(['game_id', 'genre_id']);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('Genres');
    Schema::dropIfExists('Pivot_Games_Genres');
  }
};
