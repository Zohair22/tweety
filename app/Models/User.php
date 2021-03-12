<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded =[];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tweets(): HasMany
    {
       return $this->hasMany(Tweet::class);
    }


    public function comments(): HasMany
    {
       return $this->hasMany(Comment::class);
    }

    public function message(): HasMany
    {
       return $this->hasMany(Message::class);
    }

   public function messages($id)
   {
      return Message::where('user_id', $id)->where('receiver', auth()->id())->orWhere('receiver', $id)->get();
   }



   public function getAvatarAttribute($value): string
   {
      if (isset($value)) {
         return asset('storage/' . $value);
      }else{
         return asset('images/default.jpg');
      }
   }

   public function getCoverAttribute($value): string
   {
      if (isset($value)) {
         return asset('storage/' . $value);
      }else{
         return asset('images/cover.jpg');
      }
   }

    public function timeline()
    {
       $follows = $this->follows()->pluck('id');
       return Tweet::where('user_id',$this->id)->orWhereIn('user_id', $follows)->latest()->withLikes()->paginate(7);
    }


    public function path(): string
    {
       return route('profile',$this->username);
    }

}
