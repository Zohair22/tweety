@if(isset(auth()->user()->follows))
<div class="col col-sm-auto max:col-auto ml-0 rounded-3xl">
   <div class="pt-4 px-3 rounded-3xl h-auto bg-info">

      <h1 class="display-5 font-weight-bold text-light mb-3">Following</h1>

      <ul class="list-unstyled text-white mb-5">
         @foreach( auth()->user()->follows as $follow)
         <li>
            <a href="{{ $follow->path() }}" class="d-flex align-items-center text-decoration-none text-light">
               <img src="{{ $follow->avatar }}" class="rounded-circle mr-1 mb-2" alt="" style="max-width: 40px; min-width: 40px;min-height: 40px;max-height: 40px">
               <h1 class="text-sm">{{ $follow->username }}</h1>
            </a>
         </li>
         @endforeach
      </ul>

   </div>
</div>
@endif
