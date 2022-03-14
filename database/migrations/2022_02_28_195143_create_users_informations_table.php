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
      $table->integer('user_id')->unique();
      $table->string('first_name')->nullable();
      $table->string('last_name')->nullable();
      $table->string('phone')->nullable();
      $table->string('address')->nullable();
      $table->string('post_code')->nullable();
      $table->string('city')->nullable();
      $table->string('country')->nullable();
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
