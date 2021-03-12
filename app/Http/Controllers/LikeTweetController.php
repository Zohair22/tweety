<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class LikeTweetController extends Controller
{
   public function store($id): RedirectResponse
   {
      $tweet= Tweet::findOrFail($id);
      $tweet->like(auth()->user());
      return back();
   }

   public function delete($id, Like $like): RedirectResponse
   {
      $tweet= Tweet::findOrFail($id);
      $tweet->unlike(auth()->user(),$like);
      return back();
   }
}
