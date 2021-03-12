<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesCommentsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up(): void
   {
      Schema::create('likes_comments', function (Blueprint $table) {
         $table->id();
         $table->foreignId('user_id')->constrained()->cascadeOnDelete();
         $table->foreignId('comment_id')->constrained()->cascadeOnDelete();
         $table->boolean('liked')->default(0);
         $table->timestamps();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down(): void
   {
      Schema::dropIfExists('likes_comments');
   }
}
