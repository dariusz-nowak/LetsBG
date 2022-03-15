<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up() {
    Schema::create('users_comments_likes', function (Blueprint $table) {
      $table->integer('user_id')->index();
      $table->integer('comment_id')->index();
      $table->boolean('like');
      $table->timestamps();
    });
  }

  public function down() {
    Schema::dropIfExists('users_comments_likes');
  }
};
