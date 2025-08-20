@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="container-fluid px-4 py-0 mt-0">

  {{-- Header --}}
  <div class="card shadow-sm border-0 mb-3">
    <div class="card-body py-3">
      <h3 class="fw-bold mb-2">Beranda</h3>
      <p class="mb-0">
        Selamat datang <strong>{{ auth()->user()->name ?? 'superadmin' }}</strong> di
        <a href="{{ route('home') }}" class="text-decoration-none fw-semibold">Sistem Persuratan</a>!
        Anda login sebagai
        <span class="badge rounded-pill text-bg-warning text-dark">Super Admin</span>
      </p>
      {{-- Tinjauan --}}
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body py-3">
            <h4 class="fw-bold mb-3">Tinjauan</h4>

            <div class="row g-3">
                {{-- MEMO --}}
                <div class="col-12 col-md-4">
                <div class="card card-stats card-round" style="background:#e9f2ff;">
                    <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <p class="mb-0 text-uppercase fw-bold text-dark fs-5">Memo</p>
                        <a href="{{ route('superadmin.memo.index') }}" class="small fw-semibold text-decoration-none">Lihat Semua</a>
                    </div>
                    <hr class="my-2">
                    <div class="row align-items-center">
                        <div class="col-3">
                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                            <i class="fa-solid fa-calendar-days"></i>
                        </div>
                        </div>
                        <div class="col-7 col-stats">
                        <div class="numbers">
                            <h4 class="card-title mb-0">{{ $memoCount ?? 0 }}</h4>
                            <p class="card-category mb-0">Memo</p>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>

                {{-- RISALAH RAPAT --}}
                <div class="col-12 col-md-4">
                <div class="card card-stats card-round" style="background:#e9f2ff;">
                    <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <p class="mb-0 text-uppercase fw-bold text-dark fs-5">Risalah Rapat</p>
                        <a href="{{ route('superadmin.risalah.index') }}" class="small fw-semibold text-decoration-none">Lihat Semua</a>
                    </div>
                    <hr class="my-2">
                    <div class="row align-items-center">
                        <div class="col-3">
                        <div class="icon-big text-center icon-info bubble-shadow-small">
                            <i class="fa-solid fa-clipboard-list"></i>
                        </div>
                        </div>
                        <div class="col-7 col-stats">
                        <div class="numbers">
                            <h4 class="card-title mb-0">{{ $risalahCount ?? 0 }}</h4>
                            <p class="card-category mb-0">Risalah Rapat</p>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>

                {{-- UNDANGAN RAPAT --}}
                <div class="col-12 col-md-4">
                <div class="card card-stats card-round" style="background:#e9f2ff;">
                    <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <p class="mb-0 text-uppercase fw-bold text-dark fs-5">Undangan Rapat</p>
                        <a href="{{ route('superadmin.undangan.index') }}" class="small fw-semibold text-decoration-none">Lihat Semua</a>
                    </div>
                    <hr class="my-2">
                    <div class="row align-items-center">
                        <div class="col-3">
                        <div class="icon-big text-center icon-success bubble-shadow-small">
                            <i class="fa-solid fa-file-signature"></i>
                        </div>
                        </div>
                        <div class="col-7 col-stats">
                        <div class="numbers">
                            <h4 class="card-title mb-0">{{ $undanganCount ?? 0 }}</h4>
                            <p class="card-category mb-0">Undangan Rapat</p>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>

            </div> {{-- /row --}}
            </div>
        </div>

          {{-- Aktivitas --}}
  <div class="card shadow-sm border-0">
    <div class="card-body py-3">
      <h4 class="fw-bold mb-3">Aktivitas</h4>

      <div class="row gy-2">
        {{-- Histori Memo --}}
        <div class="col-12">
          <div class="card border shadow-sm mb-0" style="background:#fff; border-radius:12px;">
            <div class="card-body p-2" style="min-height:72px;">
              <div class="d-flex align-items-center">
                <div class="me-3">
                  <div class="bg-info rounded-3 d-flex align-items-center justify-content-center" style="width:46px;height:46px;">
                    <i class="fa-solid fa-folder text-white fs-6"></i>
                  </div>
                </div>
                <div>
                  <h6 class="fw-bold mb-1 text-dark">Histori Memo</h6>
                  <p class="mb-0 text-muted small">Riwayat memo untuk kelangkah selanjutnya</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- Tambah User Baru --}}
        <div class="col-12">
          <div class="card border shadow-sm mb-0" style="background:#fff; border-radius:12px;">
            <div class="card-body p-2" style="min-height:72px;">
              <div class="d-flex align-items-center">
                <div class="me-3">
                  <div class="bg-info rounded-3 d-flex align-items-center justify-content-center" style="width:46px;height:46px;">
                    <i class="fa-solid fa-user-plus text-white fs-6"></i>
                  </div>
                </div>
                <div>
                  <h6 class="fw-bold mb-1 text-dark">Tambah User Baru</h6>
                  <p class="mb-0 text-muted small">Tinjau untuk kelangkah selanjutnya</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- Histori Permintaan Surat --}}
        <div class="col-12">
          <div class="card border shadow-sm mb-0" style="background:#fff; border-radius:12px;">
            <div class="card-body p-2" style="min-height:72px;">
              <div class="d-flex align-items-center">
                <div class="me-3">
                  <div class="bg-info rounded-3 d-flex align-items-center justify-content-center" style="width:46px;height:46px;">
                    <i class="fa-solid fa-file-pen text-white fs-6"></i>
                  </div>
                </div>
                <div>
                  <h6 class="fw-bold mb-1 text-dark">Histori Permintaan Surat</h6>
                  <p class="mb-0 text-muted small">Riwayat permintaan surat untuk kelangkah selanjutnya</p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div> 
  </div>

    </div>
  </div>

@endsection
