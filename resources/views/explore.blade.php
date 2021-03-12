@extends('components.app')

@section('content')
   <ul class="list-unstyled text-white">
      @foreach( $users as $user)
         @if($user != auth()->user())
         <li class="mb-2">
            <div class="d-flex flex-row justify-content-between">
               <a href="{{ $user->path() }}" class="d-flex align-items-center text-decoration-none">
                  <img src="{{ $user->avatar }}" class="rounded-circle mr-2 mb-2" alt="" style="width: 45px">
                  <h1 class="text-lg">{{ '@'.$user->username }}</h1>
               </a>
            @if( isset($user) && auth()->user()->username != $user->username)

               <form action="{{ $user->path() }}/{{ auth()->user()->following($user) ? 'unfollow' : 'follow' }}" method="post" class="flex-column-reverse">
                  @csrf
                  <button type="submit" class="btn btn-info text-white shadow-lg text-sm rounded-3xl px-4 ml-2">
                     {{ auth()->user()->following($user) ? 'UnFollow Me' : 'Follow Me' }}
                  </button>
               </form>
            </div>
            @endif
         </li>
         @endif
      @endforeach
   </ul>

@endsection
