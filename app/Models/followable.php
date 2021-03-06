<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait followable
{

    public function following(User $user)
   {
      return $this->follows()->where('following_user_id',$user->id)->exists();
   }

   public function follow(User $user)
   {
      return $this->follows()->save($user);
   }

   public function unfollow(User $user)
   {
      return $this->follows()->detach($user);
   }

   public function follows(): BelongsToMany
   {
      return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id');
   }
}
