<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LikesComment extends Model
{
    use HasFactory;

    protected $guarded = [];

   public function user(): BelongsTo
   {
      return $this->belongsTo(User::class,'user_id','id');
   }

   public function comment(): BelongsTo
   {
      return $this->belongsTo(Comment::class,'comment_id','id');
   }




}
