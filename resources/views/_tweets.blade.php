


<div class="border border-info card rounded-3xl mt-4">

   @foreach($tweets as $tweet)
         <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
               <a href="{{ $tweet->user->path() }}" class="d-flex align-items-center text-decoration-none text-primary">
                  <img src="{{ $tweet->user->avatar }}" class="rounded-circle mr-1" alt="" style="max-width: 40px; min-width: 40px;min-height: 40px;max-height: 40px">
                  <h4 class="text-md text-black-50">{{ $tweet->user->username }}</h4>
               </a>

               <div class="d-flex align-items-center">
                  @if (Auth::user() && (Auth::user()->id == $tweet->user_id))
                     <form method="post" action="/tweets/{{ $tweet->id }}/delete">
                        @csrf
                        @method("DELETE")
                        <button type="submit" id="delete" class="border-0 bg-transparent mr-1">
                           <i class="fas fa-trash-alt text-danger pointer-event"></i>
                        </button>
                     </form>
                     <a href="/tweets/{{ $tweet->id }}/edit" title="delete"><i class="fas fa-pen-square text-secondary text-lg"></i></a>
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
         <div class="card-footer px-3 pt-1">
            <div class="d-flex justify-content-between pb-1">
               <div class="">

                  <form action="/tweets/{{ $tweet->id }}/{{ $tweet->isLikedBy(auth()->user()) ? 'unlike' : 'like' }}" method="post" class="flex">
                     @csrf
                     <button type="submit" id="like" class="border-0 m-0 p-0 bg-transparent {{$tweet->isLikedBy(auth()->user()) ? 'text-primary' : ''}}">
                        <i class="fa fa-heart"></i>
                        {{$tweet->likes ?: 0 }}
                     </button>
                  </form>

               </div>
               <div class="flex-row-reverse">
                  <p class="text-sm text-primary p-0 m-0">{{ $tweet->created_at->diffForHumans() }}</p>
               </div>
            </div>
            <div>
               @include('comments.index')
            </div>
         </div>
         @if($loop->last)
         @else
            <hr class="text-primary m-0">
         @endif
   @endforeach


</div>
<div class="d-flex justify-content-center pagination pagination-md mt-3">
   {{ $tweets->links() }}
</div>
