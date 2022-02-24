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
    Schema::create('games', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->text('description');
      $table->text('short_description');
      $table->string('language', 20)->nullable();
      $table->string('image', 200);
      $table->float('price')->nullable();
      $table->string('price_currency', 3)->nullable();
      $table->string('min_age', 3);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('games');
  }
};
