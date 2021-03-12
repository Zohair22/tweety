

<div class="col col-8"  style="max-width: 680px">
   @if( isset($user) && auth()->user()->username==$user->username)
      @include('_publish-tweet-panel')
   @elseif(!isset($user))
      @include('_publish-tweet-panel')
   @endif
   @include('_tweets')
</div>
