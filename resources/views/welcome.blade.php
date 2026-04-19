@extends('layouts.app')
@section('title','Welcome')

@section('content')

<div class="container mt-5">

    <!-- HERO SECTION -->
    <div class="text-center mb-5">
        <h1 class="fw-bold">Sampaikan Pengaduan Anda</h1>
        <p class="text-muted">
            Platform resmi untuk menyampaikan keluhan, aspirasi, dan laporan masyarakat secara cepat dan transparan.
        </p>

        <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-2">
            Daftar Sekarang
        </a>
        <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg">
            Login
        </a>
    </div>

    <!-- FITUR -->
    <div class="row text-center mb-5">
        <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <h5>Mudah Digunakan</h5>
                <p class="text-muted">
                    Laporkan masalah hanya dalam beberapa langkah sederhana.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <h5>Respon Cepat</h5>
                <p class="text-muted">
                    Pengaduan Anda akan segera ditindaklanjuti oleh petugas.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <h5>Transparan</h5>
                <p class="text-muted">
                    Pantau status pengaduan Anda secara real-time.
                </p>
            </div>
        </div>
    </div>

    <!-- ALUR -->
    <div class="mb-5">
        <h3 class="text-center mb-4">Cara Kerja</h3>
        <div class="row text-center">
            <div class="col-md-3">
                <h5>1. Daftar</h5>
                <p class="text-muted">Buat akun terlebih dahulu</p>
            </div>
            <div class="col-md-3">
                <h5>2. Kirim Laporan</h5>
                <p class="text-muted">Isi detail pengaduan</p>
            </div>
            <div class="col-md-3">
                <h5>3. Diproses</h5>
                <p class="text-muted">Tim akan meninjau laporan</p>
            </div>
            <div class="col-md-3">
                <h5>4. Selesai</h5>
                <p class="text-muted">Masalah ditangani</p>
            </div>
        </div>
    </div>

    <!-- CTA AKHIR -->
    <div class="text-center mb-5">
        <h4>Jangan ragu untuk melaporkan masalah di sekitar Anda</h4>
        <a href="{{ route('register') }}" class="btn btn-success btn-lg mt-3">
            Mulai Sekarang
        </a>
    </div>

</div>

@endsection