<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tweet extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function user(): BelongsTo
    {
      return $this->belongsTo(User::class,'user_id','id');
    }

   public function likes(): HasMany
   {
      return $this->hasMany(Like::class, 'tweet_id', 'id');
   }

   public function comment(): HasMany
   {
      return $this->hasMany(Comment::class, 'tweet_id', 'id');
   }


   public function like($user = null, $liked = true): Model
   {
      return $this->likes()->create([
         'liked'=>$liked,
         'disliked'=>False,
         'tweet_id'=>$this->id,
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

   public function scopeWithLikes(Builder $query): Builder
   {
      return $query->leftJoinSub(
         'select tweet_id, sum(liked) likes, sum(disliked) dislikes from likes group by tweet_id',
         'likes',
         'likes.tweet_id',
         'tweets.id');
   }

}
