@extends('layouts.app')

@section('content')
<div class="register-page">
   <div class="wrapper">
      <div class="title">
         {{ __('Register Form') }}
      </div>
      <form method="POST" action="{{ route('register') }}">
         @csrf
         <div class="field">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            <label for="name">{{ __('Name') }}</label>
            @error('name')
               <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
               </span>
            @enderror
         </div>

         <div class="field">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
            <label for="email">{{ __('Email Address') }}</label>
            @error('email')
               <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
               </span>
            @enderror
         </div>

         <div class="field">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            <label for="password">{{ __('Password') }}</label>
            @error('password')
               <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
               </span>
            @enderror
         </div>

         <div class="field">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            <label for="password-confirm">{{ __('Confirm Password') }}</label>
         </div>

         <div class="field">
            <input type="submit" value="{{ __('Register') }}">
         </div>

         <div class="signup-link">
            {{ __('Already a member?') }} <a href="{{ route('login') }}">{{ __('Login now') }}</a>
         </div>
      </form>
   </div>
</div>
@endsection
