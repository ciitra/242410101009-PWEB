@extends('layouts.landing')

@section('title', 'Studio LensArt - Studio Foto Profesional')

@section('content')
<main class="public-landing">

    <nav class="public-landing-nav">
        <div class="public-landing-brand">
            Studio LensArt
        </div>

        <div class="public-landing-menu">
            <a href="{{ route('login') }}" class="public-nav-link">
                Login
            </a>

            <a href="{{ route('register') }}" class="public-nav-button">
                Register
            </a>
        </div>
    </nav>

    <section class="public-landing-hero">
        <div class="public-hero-content">
            <span class="public-hero-label">
                Studio Foto Profesional
            </span>

            <h1>
                Abadikan Momen Terbaikmu dengan Sentuhan LensArt
            </h1>

            <p>
                Reservasi studio foto kini lebih mudah, rapi, dan terjadwal.
                Pilih paket favoritmu, login ke akunmu, lalu buat jadwal pemotretan secara online.
            </p>

            <div class="public-hero-actions">
                <a href="{{ route('login') }}" class="public-primary-button">
                    Login
                </a>

                <a href="{{ route('register') }}" class="public-secondary-button">
                    Register
                </a>
            </div>
        </div>

        <div class="public-hero-visual">
            <div class="public-studio-card">
                <div class="public-logo-frame">
                    <img src="{{ asset('images/logo-lensart.png') }}" alt="Logo Studio LensArt">
                </div>

                <h2>Studio LensArt</h2>
                <p>Modern photo studio reservation</p>

                <div class="public-mini-info">
                    <span>Paket mulai Rp50.000</span>
                    <span>Reservasi online</span>
                    <span>Print & softcopy</span>
                </div>
            </div>
        </div>
    </section>

</main>
@endsection
