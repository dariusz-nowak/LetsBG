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
    Schema::create('users_informations', function (Blueprint $table) {
      $table->integer('user_id')->unique()->index();
      $table->string('first_name')->nullable()->index();
      $table->string('last_name')->nullable()->index();
      $table->integer('phone')->nullable()->index();
      $table->string('street')->nullable()->index();
      $table->string('house_number')->nullable()->index();
      $table->string('apartment_number')->nullable()->index();
      $table->string('post_code')->nullable()->index();
      $table->string('city')->nullable()->index();
      $table->string('country')->nullable()->index();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('users_informations');
  }
};
