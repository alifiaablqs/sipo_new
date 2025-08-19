@extends('layouts.auth')

@section('title', 'Lupa Kata Sandi')

@section('content')
<div class="container">
    <div class="card">
        <div class="back-button">
            <a href="{{ url('/') }}">
                <img src="{{ asset('img/user-manage/Vector_back.png') }}" alt="back">
            </a>
        </div>

        <div class="logo">
            <img src="{{ asset('img/logo-reka.png') }}" alt="Reka Inka Group">
        </div>

        <h1>Lupa Kata Sandi</h1>
        <p>Masukkan email Anda untuk proses verifikasi, kami akan mengirimkan kode 4 digit ke email Anda.</p>

        <form action="{{ route('forgot-password.send') }}" method="POST">
            @csrf
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter email" required>

            <button type="submit">MELANJUTKAN</button>
        </form>
    </div>
</div>
@endsection
