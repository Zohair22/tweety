<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('messages', function (Blueprint $table) {

         $table->id();
         $table->foreignId('user_id');
         $table->foreignId('receiver');
         $table->text('message');
         $table->timestamps();

         $table->foreign("user_id")->references('id')->on('users')->cascadeOnDelete();
         $table->foreign("receiver")->references('id')->on('users')->cascadeOnDelete();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::dropIfExists('messages');
   }
}
