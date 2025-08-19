@extends('layouts.auth')

@section('title', 'Verifikasi Email')

@section('content')
<div class="container">
    <div class="card">
        <div class="back-button">
            <a href="{{ route('forgot-password') }}">
                <img src="{{ asset('img/user-manage/Vector_back.png') }}" alt="back">
            </a>
        </div>

        <div class="logo">
            <img src="{{ asset('img/logo-reka.png') }}" alt="Reka Inka Group">
        </div>

        <h1>Verifikasi Email</h1>
        <p>Kami telah mengirimkan kode 4 digit ke email: <strong>{{ $email }}</strong></p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('verify-code.verify') }}" method="POST">
            @csrf
            <label for="verification_code">Masukkan Kode Verifikasi</label>
            <div class="verification-inputs">
                <input type="text" name="digit1" maxlength="1" pattern="[0-9]" required>
                <input type="text" name="digit2" maxlength="1" pattern="[0-9]" required>
                <input type="text" name="digit3" maxlength="1" pattern="[0-9]" required>
                <input type="text" name="digit4" maxlength="1" pattern="[0-9]" required>
            </div>

            <button type="submit">VERIFIKASI</button>
        </form>

        <div class="resend-section">
            <p>Tidak menerima kode? <a href="{{ route('resend-code') }}">Kirim ulang</a></p>
        </div>
    </div>
</div>

<style>
.verification-inputs {
    display: flex;
    gap: 10px;
    justify-content: center;
    margin: 20px 0;
}

.verification-inputs input {
    width: 50px;
    height: 50px;
    text-align: center;
    font-size: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.resend-section {
    text-align: center;
    margin-top: 20px;
}

.resend-section a {
    color: #007bff;
    text-decoration: none;
}
</style>

<script>
// Auto-focus next input when typing
document.querySelectorAll('.verification-inputs input').forEach((input, index) => {
    input.addEventListener('input', function() {
        if (this.value.length === 1 && index < 3) {
            document.querySelectorAll('.verification-inputs input')[index + 1].focus();
        }
    });
    
    input.addEventListener('keydown', function(e) {
        if (e.key === 'Backspace' && this.value.length === 0 && index > 0) {
            document.querySelectorAll('.verification-inputs input')[index - 1].focus();
        }
    });
});
</script>
@endsection
