<?php

namespace App\Http\Controllers;

use App\Models\User;

class FollowsController extends Controller
{
    public function store(User $user)
    {
        auth()->user()->follow($user);
        return back();
    }

    public function delete(User $user)
    {
        auth()->user()->unfollow($user);
        return back();
    }
}
