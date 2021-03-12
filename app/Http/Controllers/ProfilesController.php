<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfilesController extends Controller
{
    public function show(User $user)
    {
       $comments = Comment::all();
       return view('profiles.index',[
          'user' => $user,
          'tweets' => $user->tweets()->latest()->withLikes()->paginate(4),
          'comments'=>$comments
       ]);
    }


    public function edit (User $user)
    {
       return view('profiles.edit',compact('user'));
    }

   /**
    *
    * @param User $user
    * @return string
    */
   protected function update(User $user)
   {
      $attributes = request()->validate([
         'username' => ['string', 'max:255', Rule::unique('users')->ignore($user), 'alpha_dash '],
         'name' => ['string', 'max:255'],
         'description' => ['string', 'max:255'],
         'avatar' => ['file'],
         'cover' => ['file'],
         'email' => ['string', 'email', 'max:255', Rule::unique('users')->ignore($user)],
         'password' => ['string', 'min:8', 'confirmed'],
      ]);

      if (request('avatar'))
      {
         $attributes['avatar'] = $attributes['avatar']->store('avatars');
      }

      if (request('cover'))
      {
         $attributes['cover'] = $attributes['cover']->store('avatars');
      }

      $attributes['password'] = Hash::make(request('password'));
      $user->update($attributes);

      return redirect($user->path());
   }
}
