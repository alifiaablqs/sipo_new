@extends('layouts.app')

@section('title', 'Informasi SIPO')

@section('content')
<div class="info">
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                {{-- Header Card (Back Button + Title + Breadcrumb) --}}
                <div class="card-header bg-white border-bottom">
                    <div class="d-flex align-items-center flex-wrap">
                        <!-- Back Button -->
                        <a href="#" class="btn btn-icon btn-round btn-primary me-2">
                            <i class="fa fa-arrow-left"></i>
                        </a>

                        <!-- Title -->
                        <h4 class="page-title mb-0 me-3">Info</h4>

                        <!-- Breadcrumb -->
                        <ul class="breadcrumbs mb-0">
                            <li class="nav-home">
                                <a href="#"><i class="fa fa-home"></i></a>
                            </li>
                            <li class="separator"><i class="fa fa-chevron-right"></i></li>
                            <li class="nav-item">
                                <a href="#">Beranda</a>
                            </li>
                            <li class="separator"><i class="fa fa-chevron-right"></i></li>
                            <li class="nav-item">
                                <a href="#">Info</a>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Content --}}
                <div class="card-body text-center">
                    <!-- Background Container -->
                    <div class="bg-container mb-4">
                        <p>
                            <strong>Tentang Sistem</strong><br><br>
                            Sistem manajemen persuratan ini dirancang untuk memudahkan pengelolaan Memo,
                            Undangan Rapat, dan Risalah Rapat di dalam ruang lingkup PT Rekaindo Global Jasa.
                            Sistem ini memungkinkan pembuatan, pengeditan, persetujuan, dan pengarsipan dokumen
                            secara efisien.
                        </p>
                    </div>

                    <!-- Logo di bawah -->
                    <div class="reka-info mt-3">
                        <img src="/assets/img/reka-info.png" alt="Info">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
