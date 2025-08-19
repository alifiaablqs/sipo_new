@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')
<div class="container">
    <div class="card">
        <div class="back-button">
            <a href="{{ route('verify-code') }}">
                <img src="{{ asset('img/user-manage/Vector_back.png') }}" alt="back">
            </a>
        </div>

        <div class="logo">
            <img src="{{ asset('img/logo-reka.png') }}" alt="Reka Inka Group">
        </div>

        <h1>Reset Password</h1>
        <p>Masukkan password baru untuk akun: <strong>{{ $email }}</strong></p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reset-password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">
            
            <div class="form-group">
                <label for="password">Password Baru</label>
                <div class="input-wrapper">
                    <span class="icon-chip"><i class="fas fa-lock"></i></span>
                    <input type="password" id="password" name="password" 
                           class="form-control input-elev ps-5 pe-5" 
                           placeholder="Masukkan password baru" required minlength="8">
                    <i class="fas fa-eye password-toggle" onclick="togglePassword(this)"></i>
                </div>
            </div>

            <div class="form-group mt-3">
                <label for="password_confirmation">Konfirmasi Password</label>
                <div class="input-wrapper">
                    <span class="icon-chip"><i class="fas fa-lock"></i></span>
                    <input type="password" id="password_confirmation" name="password_confirmation" 
                           class="form-control input-elev ps-5 pe-5" 
                           placeholder="Konfirmasi password baru" required minlength="8">
                    <i class="fas fa-eye password-toggle" onclick="togglePassword(this)"></i>
                </div>
            </div>

            <button type="submit" class="btn btn-submit mt-3 w-100">RESET PASSWORD</button>
        </form>
    </div>
</div>

<script>
function togglePassword(el){
  const input = el.parentElement.querySelector('input[type="password"], input[type="text"]');
  if(!input) return;
  if(input.type === 'password'){ 
    input.type = 'text'; 
    el.classList.replace('fa-eye','fa-eye-slash'); 
  }
  else { 
    input.type = 'password'; 
    el.classList.replace('fa-eye-slash','fa-eye'); 
  }
}
</script>
@endsection
