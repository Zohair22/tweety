<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Tweet;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return Application|Factory|View|Response
    */
    public function index()
    {
       $comments = Comment::all();
        return view('comments.index',compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

   /**
    * Store a newly created resource in storage.
    *
    * @param Tweet $tweet
    * @return RedirectResponse
    */
   public function store($tweet): RedirectResponse
   {
      $attribute = request()->validate([
         'comment' => 'required|max:255'
      ]);

      Comment::create([
         'user_id' => auth()->id(),
         'tweet_id' => $tweet,
         'comment' => $attribute['comment']
      ]);

      return back();
   }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

   /**
    * Show the form for editing the specified resource.
    *
    * @param int $id
    * @return Application|Factory|View|Response
    */
    public function edit(int $id)
    {
//       ?
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

   /**
    * Remove the specified resource from storage.
    *
    * @param int $id
    * @return RedirectResponse
    */
    public function destroy(int $id): RedirectResponse
    {
       $comment = Comment::findOrFail($id);
       $comment->delete();
       return back();
    }
}
