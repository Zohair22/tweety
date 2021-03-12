<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class MessageController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @param User $message
    * @param $id
    * @return Application|Factory|View|Response
    */
    public function index(User $message,$id)
    {
       $messages = $message->messages($id);

       $user = User::find($id);
       return view('messages.index',[
          'messages'=>$messages,
          'user'=>$user
       ]);
    }

   /**
    * Show the form for creating a new resource.
    *
    * @param Message $message
    * @return Application|Factory|View|Response
    */
    public function create(Message $message)
    {
       return view('messages.index',compact('message'));
    }

   /**
    * Store a newly created resource in storage.
    *
    * @param $id
    * @param Request $request
    * @return RedirectResponse
    */
    public function store($id , Request $request): RedirectResponse
    {
       $attributes = $request->validate([
          'message' => ['required', 'string', 'max:255'],
          'user_id'=>'',
          'receiver'=>''
       ]);


       $attributes['user_id'] = auth()->id();
       $attributes['receiver'] = $id;

       Message::create($attributes);
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
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
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
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
