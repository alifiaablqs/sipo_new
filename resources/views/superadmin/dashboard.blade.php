@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="container-fluid px-4 py-0 mt-0">
    <div class="card shadow-sm border-0">
            <div class="card-body py-3">
                <h3><strong>Beranda</strong></h3>
                <p class="mb-0">
                Selamat datang <strong>{{ auth()->user()->name ?? 'superadmin' }}</strong> di 
                <a href="{{ route('home') }}" class="text-decoration-none fw-semibold">Sistem Persuratan</a>!
                Anda login sebagai
                <span class="badge rounded-pill text-bg-warning text-dark">Super Admin</span>
            </p>
            </div>

            </div>
        </div>
    </div>
    </div>
</div>
@endsection