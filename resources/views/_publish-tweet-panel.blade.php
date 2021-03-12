


<div class="border border-info rounded-3xl p-3 ">
   <form action="/tweets" method="post" enctype="multipart/form-data">
      @csrf
      <textarea name="body" id="" class="w-100 px-2 py-3 rounded-3xl border-primary" rows="2" style="background-color: #fff;" placeholder="What's Up Dude!.."></textarea>
      <img class="mt-1 mx-auto fixe" src="" id="G" hidden alt="your image" style="max-width:100%">

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
         <img src="{{ auth()->user()->avatar }}" class="rounded-circle mr-1 mb-2" alt="" style="max-width: 35px; min-width: 35px;min-height: 35px;max-height: 35px">
         <button type="submit" class="btn btn-primary btn-sm rounded-3xl shadow-lg px-4 py-2">Tweet-a-roo!</button>
      </div>
   </form>
</div>
