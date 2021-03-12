

<x-master>
   <main class="py-3">
      <div class="container">
         <div class="mx-auto">
            <div class="row mx-auto">
               @auth
                  @include('_friend-list')
               @endauth
               <div class="col max:col-8 col-sm-12 ml-0 " style="max-width: 680px">
                  @yield('content')
               </div>
            </div>
         </div>
      </div>
   </main>
</x-master>
