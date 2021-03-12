<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('comments', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id');
      $table->foreignId('tweet_id');
      $table->text('comment')->nullable();
      $table->text('photo')->nullable();
      $table->timestamps();

      $table->foreign("user_id")->references('id')->on('users')->cascadeOnDelete();
      $table->foreign("tweet_id")->references('id')->on('tweets')->cascadeOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('comments');
  }
}
