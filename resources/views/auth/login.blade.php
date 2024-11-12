@extends('layouts.app')

@section('content')
<div class="login-page">
   <div class="wrapper">
      <div class="title">
         {{ __('Login Form') }}
      </div>
      <form method="POST" action="{{ route('login') }}">
         @csrf
         <div class="field">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            <label>{{ __('Email Address') }}</label>
            @error('email')
               <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
               </span>
            @enderror
         </div>

         <div class="field">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            <label>{{ __('Password') }}</label>
            @error('password')
               <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
               </span>
            @enderror
         </div>

         <div class="content">
            <div class="checkbox">
               <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
               <label for="remember">{{ __('Remember Me') }}</label>
            </div>
            <div class="pass-link">
               @if (Route::has('password.request'))
                  <a href="{{ route('password.request') }}">{{ __('Forgot password?') }}</a>
               @endif
            </div>
         </div>

         <div class="field">
            <input type="submit" value="{{ __('Login') }}">
         </div>
         <div class="signup-link">
            {{ __('Not a member?') }} <a href="{{ route('register') }}">{{ __('Signup now') }}</a>
         </div>
      </form>
   </div>
</div>
@endsection
