<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\RedirectResponse;

class LikeCommentController extends Controller
{
   public function store($id): RedirectResponse
   {
      $comment=Comment::findOrFail($id);
      $comment->like(auth()->user());
      return back();
   }

   public function delete($id, Like $like): RedirectResponse
   {
      $comment=Comment::findOrFail($id);
      $comment->unlike(auth()->user(),$like);
      return back();
   }
}
