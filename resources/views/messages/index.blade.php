@extends('components.app')

@section('content')

   <div class="card text-center">
      <div class="card-header text-left d-flex ">
         <a href="{{ $user->path() }}" class="d-flex align-items-center text-decoration-none text-primary">
            <img src="{{ $user->avatar }}" class="rounded-circle mr-1" alt="" style="width: 40px">
            <h4 class="text-lg text-black">{{ $user->username }}</h4>
         </a>
      </div>


      <div class="card-body p-3 pre-scrollable" style=" height: 600px;max-height: 520px;" id="app">
         <div class="card-text">
            @foreach($messages as $message)
               @if($message->receiver === auth()->id())
                  <div class="d-flex flex-row">
                     <div>
                        <img src="{{ $user->avatar }}" class="rounded-circle mr-1" alt="" style="width: 25px">
                     </div>
                     <p class="text-sm text-left border border-secondary bg-secondary text-light p-2 shadow-lg rounded-3xl mb-1 message" style="max-width: 60%"  @if($loop->last) autofocus @endif>
                        {{ $message->message }}
                     </p>
                  </div>
                  <p class="text-xs text-secondary text-left mt-1">
                     {{ $message->created_at->diffForHumans() }}
                  </p>
               @elseif($message->user_id === auth()->id() )
                  <div class="d-flex flex-row-reverse mb-0 p-0">
                     <div class="p-0 m-0">
                        <img src="{{ auth()->user()->avatar }}" class="rounded-circle ml-1" alt="" style="max-width: 25px; min-width: 25px;min-height: 25px;max-height: 25px">
                     </div>

                        <p class="text-sm text-left border border-primary bg-primary text-light p-2 shadow-lg rounded-3xl mb-1" style="max-width: 60%" id="results">
                           {{ $message->message }}
                        </p>
                  </div>
                     <p class="text-xs text-primary text-right mt-1  message">
                        {{ $message->created_at->diffForHumans() }}
                     </p>
               @endif
            @endforeach
         </div>
      </div>
      <div class="card-footer text-muted">
         <form action="/message/{{$user->id}}/message" method="post" enctype="multipart/form-data">
            @csrf
            <div class="d-flex flex-row justify-content-between align-items-center">
               <div class="d-flex align-items-center">
                  <img src="{{ auth()->user()->avatar }}" class="rounded-circle mr-1 mb-2" alt="" style="max-width: 25px; min-width: 25px;min-height: 25px;max-height: 25px">
               </div>

               <input name="message" class="form-control mr-1 rounded-3xl" id="message" autofocus style="background-color: #fff;" required>

               <hr class="border-top border-info">
               @error('message')
               <p class="alert alert-danger p-1">
                  {{ $message }}
               </p>
               @enderror

               <div class="d-flex align-items-center">
                  <button type="submit" class="btn btn-primary btn-sm rounded-3xl shadow-lg text-sm" id="send_message">send</button>
               </div>

            </div>
         </form>
      </div>
   </div>

@endsection
