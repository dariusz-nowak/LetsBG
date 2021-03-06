<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up() {
    Schema::create('pivot_users_likes', function (Blueprint $table) {
      $table->integer('user_id')->index();
      $table->integer('users_games_comment_id')->index();
      $table->dateTime('created_at');
    });
  }

  public function down() {
    Schema::dropIfExists('pivot_users_likes');
  }
};
