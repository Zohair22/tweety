@extends('components.app')

@section('content')
      <div class="container mt-5">
         <div class="row justify-content-center">
            <div class="col-md-12">
               <div class="card bg-info text-white">
                  <div class="card-header">{{ __('Edit') }}</div>

                  <div class="card-body">
                     <form method="POST" action="{{ $user->path() }}/edit" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group row">
                           <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                           <div class="col-md-6">
                              <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ auth()->user()->username }}" required autocomplete="username" autofocus>

                              @error('username')
                              <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                              @enderror
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                           <div class="col-md-6">
                              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ auth()->user()->name }}" required autocomplete="name" autofocus>

                              @error('name')
                              <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                              @enderror
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                           <div class="col-md-6">
                              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ auth()->user()->email }}" required autocomplete="email">

                              @error('email')
                              <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                              @enderror
                           </div>
                        </div>


                        <div class="form-group row">
                           <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description Address') }}</label>

                           <div class="col-md-6">
                              <textarea id="description" type="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ auth()->user()->description }}" required autocomplete="description"></textarea>

                              @error('description')
                              <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                              @enderror
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('Avatar') }}</label>

                           <div class="col-md-6">
                              <input id="avatar" type="file" class="form-control-file @error('avatar') is-invalid @enderror" name="avatar" value="{{ auth()->user()->avatar }}">

                              @error('avatar')
                              <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                              @enderror
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                           <div class="col-md-6">
                              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                              @error('password')
                              <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                              @enderror
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                           <div class="col-md-6">
                              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                           </div>
                        </div>

                        <div class="form-group row mb-0">
                           <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                 {{ __('Update') }}
                              </button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
@endsection
