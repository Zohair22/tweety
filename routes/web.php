<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\LikeCommentController;
use App\Http\Controllers\LikedController;
use App\Http\Controllers\LikeTweetController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\TweetController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::middleware('auth')->group( function (){

   Route::get('/', [TweetController::class, 'index'])->name('home');
   Route::post('/tweets', [TweetController::class, 'store'])->name('tweets');
   Route::get('/tweets/{tweets:id}',[TweetController::class, 'show']);
   Route::get('/tweets/{tweets:id}/edit',[TweetController::class, 'edit']);
   Route::patch('/tweets/{tweets:id}/edit',[TweetController::class, 'update']);
   Route::delete('/tweets/{id}/delete', [TweetController::class, 'destroy']);

   Route::post( '/tweets/{tweets}/like', [LikeTweetController::class, 'store']);
   Route::post( '/tweets/{tweets}/unlike', [LikeTweetController::class, 'delete']);


   Route::post( '/profile/{user:username}/follow', [FollowsController::class, 'store']);
   Route::post( '/profile/{user:username}/unfollow', [FollowsController::class, 'delete']);

   Route::get('/profile/{user:username}', [ProfilesController::class, 'show'])->name('profile');
   Route::patch('/profile/{user:username}',[ProfilesController::class,'update'])->middleware('can:edit,user');
   Route::get('/profile/{user:username}/edit', [ProfilesController::class, 'edit'])->name('edit_profile')->middleware('can:edit,user',);
   Route::patch('/profile/{user:username}/edit', [ProfilesController::class, 'update'])->middleware('can:edit,user',);



   Route::post('/comment/{tweet}', [CommentController::class, 'store'])->name('comment');
   Route::delete('/comment/{id}/delete', [CommentController::class, 'destroy']);
   Route::post( '/comment/{comment}/like', [LikeCommentController::class, 'store']);
   Route::post( '/comment/{comment}/unlike', [LikeCommentController::class, 'delete']);



   Route::get('/message/{id}', [MessageController::class, 'index'])->name('messages');
   Route::get('/message/{id}/message', [MessageController::class, 'create']);
   Route::post('/message/{id}/message', [MessageController::class, 'store'])->name('sent_message');





   Route::get('explore', [ExploreController::class, 'index'])->name('explore');

});
