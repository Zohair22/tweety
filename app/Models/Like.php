<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    use HasFactory;

    protected $guarded =[];

   public function user(): BelongsTo
   {
      return $this->belongsTo(User::class,'user_id','id');
   }

   public function tweet(): BelongsTo
   {
      return $this->belongsTo(Tweet::class,'tweet_id','id');
   }

}
