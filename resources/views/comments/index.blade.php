

<hr class="text-secondary mt-0 mb-2">
@foreach($comments as $comment)
   @if($comment->tweet_id == $tweet->id )
      <div class="d-flex justify-content-between align-items-center pb-0">
         <a href="{{ $comment->user->path() }}" class="d-flex align-items-center text-decoration-none">
            <img src="{{ $comment->user->avatar }}" class="rounded-circle mr-1" alt="" style="max-width: 30px; min-width: 30px;min-height: 30px;max-height: 30px">
            <h4 class="text-sm text-black-50">{{ $comment->user->username }}</h4>
         </a>

         <div class="d-flex align-items-center">
            @if (Auth::user() && (Auth::user()->id == $comment->user_id))
               <form method="post" action="/comment/{{ $comment->id }}/delete">
                  @csrf
                  @method("DELETE")
                  <button type="submit" id="delete" class="border-0 bg-transparent mr-1">
                     <i class="fas fa-trash-alt text-danger pointer-event"></i>
                  </button>
               </form>
            @endif
         </div>

      </div>
      <div class="text-sm ml-5 text-primary text-truncate mb-0">
         <p>{{ $comment->comment }}</p>
      </div>

         <div class="d-flex justify-content-between pb-1">
            <form action="/comment/{{ $comment->id }}/{{ $comment->isLikedBy(auth()->user()) ? 'unlike' : 'like' }}" method="post" class="flex">
               @csrf
               <button type="submit" id="like" class="border-0 m-0 p-0 bg-transparent {{$comment->isLikedBy(auth()->user()) ? 'text-primary' : ''}}">
                  <i class="fa fa-heart"></i>
                  {{$comment->likes->count() ?: 0 }}
               </button>
            </form>
            <div class="flex-row-reverse">
               <p class="text-sm text-primary p-0 m-0">{{ $comment->created_at->diffForHumans() }}</p>
            </div>
      </div>

      <hr class="text-secondary m-0 mb-2">
   @endif
@endforeach

   <form action="/comment/{{$tweet->id}}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="d-flex flex-row justify-content-between align-items-center">
         <div class="d-flex align-items-center">
            <img src="{{ auth()->user()->avatar }}" class="rounded-circle mr-1 mb-2" alt="" style="max-width: 30px; min-width: 30px;min-height: 30px;max-height: 30px">
         </div>

         <input name="comment" class="form-control mr-1 rounded-3xl" style="background-color: #fff;" required>

         <hr class="border-top border-info">
         @error('body')
         <p class="alert alert-danger p-1">
            {{ $message }}
         </p>
         @enderror

         <div class="d-flex align-items-center">
            <button type="submit" class="btn btn-primary btn-sm rounded-3xl shadow-lg text-sm">comment</button>
         </div>

      </div>
   </form>
