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
    Schema::create('Producers', function (Blueprint $table) {
      $table->id();
      $table->string('name', 64);
      $table->timestamps();
    });

    Schema::create('Pivot_Games_Producers', function (Blueprint $table) {
      $table->integer('game_id')->index();
      $table->integer('producer_id')->index();

      $table->index(['game_id', 'producer_id']);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('Producers');
    Schema::dropIfExists('Pivot_Games_Producers');
  }
};
