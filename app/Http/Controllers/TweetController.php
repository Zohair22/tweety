<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Tweet;
use Illuminate\Http\RedirectResponse;

class TweetController extends Controller
{

   public function __construct()
   {
      $this->middleware('auth');
   }

   public function index()
   {
      $tweets = auth()->user()->timeline();
      $comments = Comment::all();
      return view('tweets.index',[
         'tweets'=>$tweets,
         'comments'=>$comments
      ]);
   }


    public function store(): RedirectResponse
    {
       if (request('photo'))
       {
          $attribute = request()->validate([
             'body'  =>  'max:255',
             'photo' =>  'file',
             'user_id' => '',
          ]);
       }

       if (!request('photo'))
       {
          $attribute = request()->validate([
             'body'  =>  'max:255|required',
             'photo' =>  'file',
             'user_id' => '',
          ]);
       }
       $attribute['user_id']  = auth()->id();
       if (request('photo')) {
          $attribute['photo'] = request('photo')->store('avatars');
       }

       Tweet::create($attribute);

       return back();
    }

    public function edit($id)
    {
       $tweet = Tweet::findOrFail($id);
       return view('tweets.update',compact('tweet'));
    }

    public function update($id)
    {
       $tweet = Tweet::findOrFail($id);
       $attribute = request()->validate([
          'body' => 'required|max:255'
       ]);

        $tweet->update([
          'user_id' => auth()->id(),
          'body' => $attribute['body']
       ]);

        $tweet->save();

       return redirect(route('home'));
    }

   public function destroy($id): RedirectResponse
   {
      $tweet = Tweet::findOrFail($id);
      $tweet->delete();
      return redirect(route('home'));
   }
}
