<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
   protected $guarded = [];

   public function users()
   {
      $this->belongsToMany(
         User::class,
         'users',
         'user_id',
         'receiver',
      );
   }

   public function message()
   {
      return $this->where('user_id',auth()->id())->where('receiver',$this->id)->get();
   }

}
