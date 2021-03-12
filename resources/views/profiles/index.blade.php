@extends('components.app')

@section('content')
   <header>
      <div class="position-relative">

            <form method="post" action="{{ $user->path() }}" enctype="multipart/form-data" id="forms">
               @csrf
               @method('PATCH')
               <div id="cover" class="relative" style="width: 100%;height: 220px">
                  <img src="{{ $user->cover }}" alt="" class="w-100 rounded-3xl" style="min-height: 215px !important;max-height: 215px">
                  @can('edit',$user)
                     <label for="upload-cover" style="top:-40px;left:calc(100% - 140px);" class="cursor-pointer position-relative
         rounded-3xl text-xs px-3 py-2 courser badge-primary text-light">
                        <i class="fas fa-camera-retro mr-1"></i>Edit cover photo
                     </label>
                     <input id="upload-cover" type="file" name="cover" hidden>
                  @endcan
               </div>
               @error('cover')
               <p class="ml-1 text-lg text-danger">{{ $message }}</p>
               @enderror
            </form>

            <form method="post" action="{{ $user->path() }}" enctype="multipart/form-data" id="form-avatar">
               @csrf
               @method('PATCH')
               <div class="relative">
                  <img id="avatar" src="{{ asset($user->avatar) }}" class="rounded-circle position-absolute img-thumbnail mr-2" alt="" style="top: calc( 50% + 40px);left: calc(50% - 60px);width: 120px; max-width: 120px; min-width: 120px;max-height: 120px; min-height: 120px;">
                  @can('edit',$user)
                     <label for="upload-avatar" style="left:calc(100% - 285px);top:20px" class="cursor-pointer position-relative
         rounded-3xl text-lg courser pl-1 text-light border border-primary">
                        <i class="fas fa-camera-retro mr-1 text-primary text-lg"></i>
                     </label>
                     <input id="upload-avatar" type="file" name="avatar" hidden>
                  @endcan
               </div>
               @error('avatar')
               <p class="mr-2 text-lg text-danger">{{ $message }}</p>
               @enderror
            </form>
         </div>


      <div class="d-flex justify-content-between align-content-center">

         <div class="text-primary" style="max-width: 200px">
            <h5 class="font-weight-bold mb-0">{{ $user->name }}</h5>
            <p class="text-sm">Joined at {{ $user->created_at->diffForHumans() }}</p>
         </div>

         <div class="d-flex">
            @can('edit',$user)
               <div>
                  <a class="btn btn-outline-primary shadow-lg text-sm rounded-3xl px-4" href="{{ $user->path() }}/edit">Edit Profile</a>
               </div>
            @endcan

            @if( isset($user) && auth()->user()->username != $user->username)

               <form action="{{ $user->path() }}/{{ auth()->user()->following($user) ? 'unfollow' : 'follow' }}" method="post">
                  @csrf
                  <button type="submit" class="btn btn-info text-white shadow-lg text-sm rounded-3xl px-4 ml-2">
                     {{ auth()->user()->following($user) ? 'UnFollow Me' : 'Follow Me' }}
                  </button>
               </form>

               <div>
                  <a href="/message/{{ $user->id }}" class="btn btn-success shadow-lg text-sm rounded-3xl px-4 ml-2">Chat</a>
               </div>
            @endif
         </div>

      </div>
      @if(isset($user->description))
         <p class="text-sm">{{ $user->description }}</p>
      @endif
   </header>
   @include('_timeline',['tweets'=>$tweets])
@endsection
