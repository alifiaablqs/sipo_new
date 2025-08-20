@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Profil</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="{{ route('dashboard') }}">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Profil</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-12"> {{-- full width --}}
            <div class="card p-4 shadow-sm rounded-3">

                {{-- Tombol Edit Profil di kanan atas --}}
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('edit-profile') }}" class="btn btn-warning fw-bold text-white px-4">
                        Edit Profil
                    </a>
                </div>

                {{-- Foto Profil & Info Utama --}}
                <div class="text-center mb-4">
                    @if($user->profile_image)
                        <img src="data:image/png;base64,{{ $user->profile_image }}"
                             alt="profile-photo"
                             class="rounded-circle img-fluid mb-3"
                             style="max-width:120px; height:120px; object-fit:cover;">
                    @else
                        <img src="{{ asset('img/default-logo.png') }}"
                             alt="default-photo"
                             class="rounded-circle img-fluid mb-3"
                             style="max-width:120px; height:120px; object-fit:cover;">
                    @endif

                    <h5 class="fw-bold mb-1">{{ $user->firstname }} {{ $user->lastname }}</h5>
                    <p class="text-muted">{{ $user->email }}</p>
                </div>

                {{-- Detail Profil --}}
                <div class="row g-3"> {{-- pakai g-3 biar ada gap antar kolom --}}
                    <div class="col-md-6">
                        <label class="fw-bold text-primary">Posisi</label>
                        <div class="form-control bg-light">{{ $position ?? '-' }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold text-primary">Email</label>
                        <div class="form-control bg-light">{{ $user->email }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold text-primary">Nama Depan</label>
                        <div class="form-control bg-light">{{ $user->firstname }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold text-primary">Nama Belakang</label>
                        <div class="form-control bg-light">{{ $user->lastname }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold text-primary">Nama Pengguna</label>
                        <div class="form-control bg-light">{{ $user->username }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold text-primary">Nomor Telepon</label>
                        <div class="form-control bg-light">{{ $user->phone_number ?? '-' }}</div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
