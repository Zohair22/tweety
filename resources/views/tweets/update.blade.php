
@extends('components.app')

@section('content')
   <div class="border border-info rounded-3xl p-3 ">
      <form action="/tweets/{{ $tweet->id }}/edit" method="post" enctype="multipart/form-data">
         @csrf
         @method('PATCH')
         @if(isset($tweet->body))
         <textarea name="body" id="" class="w-100 px-2 py-3 rounded-3xl border-primary" rows="2" style="background-color: #fff;" placeholder="What's Up Dude!.." required>{{ $tweet->body }}</textarea>
         @endif
         @if(isset($tweet->photo))
         <img class="mt-1 mx-auto fixe" src="{{ asset('storage/'.$tweet->photo) }}" id="G" alt="your image" style="max-width:100%">
         @endif

         <div class="">
            <label for="photos" class="cursor-pointer text-lg text-primary rounded-3xl text-white px-4 py-1">
               <i class="fas fa-camera-retro"></i>
            </label>
            <input id="photos" type="file" name="photo" hidden onchange="readURL(this);">
         </div>

         <hr class="border-top border-info">
         @error('body')
         <p class="alert alert-danger p-1">
            {{ $message }}
         </p>
         @enderror
         @error('photo')
         <p class="alert alert-danger p-1">
            {{ $message }}
         </p>
         @enderror
         <div class="d-flex justify-content-between align-items-center">
            <img src="{{ auth()->user()->avatar }}" class="rounded-circle mr-1 mb-2" alt="" style="width: 35px">
            <button type="submit" class="btn btn-primary btn-sm rounded-3xl shadow-lg px-4 py-2">Tweet-a-roo!</button>
         </div>
      </form>
   </div>

   <div class="border border-info card rounded-3xl mt-4">
      <div class="card-body">
         <div class="d-flex justify-content-between align-items-center">
            <a href="{{ $tweet->user->path() }}" class="d-flex align-items-center text-decoration-none text-primary-50">
               <img src="{{ $tweet->user->avatar }}" class="rounded-circle mr-1" alt="" style="width: 40px">
               <h4 class="text-md text-black-50">{{ $tweet->user->username }}</h4>
            </a>

            <div class="d-flex justify-content-center">
               @if (Auth::user() && (Auth::user()->id == $tweet->user_id))
                  <form method="post" action="/tweets/{{ $tweet->id }}/delete">
                     @csrf
                     @method("DELETE")
                     <button type="submit" id="delete" class="border-0 bg-transparent">
                        <i class="fas fa-trash-alt text-danger pointer-event"></i>
                     </button>
                  </form>
               @endif
            </div>

         </div>
         <div class="text-sm ml-5 text-primary text-truncate">
            @if (isset($tweet->body))
               <p>{{ $tweet->body }}</p>
            @endif

            @if (isset($tweet->photo))
               <img id="photo" src="{{ asset('storage/'.$tweet->photo) }}" class="shadow-xl border border-double border-blue-600 my-3 mx-auto" style="max-width: 500px; max-height: 500px" alt="">
            @endif
         </div>
      </div>
   </div>
@endsection
