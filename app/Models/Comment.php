<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;

   protected $guarded =[];


   public function user(): BelongsTo
   {
      return $this->belongsTo(User::class,'user_id','id');
   }

   public function likes(): HasMany
   {
      return $this->hasMany(LikesComment::class, 'comment_id', 'id');
   }

   public function tweet(): BelongsTo
   {
      return $this->belongsTo(Tweet::class,'tweet_id','id');
   }


   public function like($user = null, $liked = true): Model
   {
      return $this->likes()->create([
         'liked'=>$liked,
         'comment_id'=>$this->id,
         'user_id'=>auth()->id() ?? $user->id,
      ]);
   }

   public function unlike($user = null,$like = null)
   {
      return $this->likes()->where('user_id', $user->id)->delete($like);
   }

   public function isLikedBy(User $user): bool
   {
      return (bool) $this->likes()->where('user_id', $user->id)->where('liked', True)->count();
   }


}
