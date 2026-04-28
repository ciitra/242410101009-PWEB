@extends('layouts.app')

@section('title', 'Tentang Studio LensArt')

@section('content')

<section class="about-hero">
    <div class="about-hero-content">
        <img src="{{ asset('images/logo-lensart.png') }}" alt="Logo Studio LensArt" class="about-logo">
        <h1>Tentang Studio LensArt</h1>
        <p>
            Studio LensArt adalah studio foto kreatif yang hadir untuk membantu setiap pelanggan
            mengabadikan momen terbaik dengan hasil foto yang estetik, nyaman, dan berkesan.
        </p>
    </div>
</section>

<section class="about-section">
    <div class="about-card">
        <h2>Siapa Kami?</h2>
        <p>
            Studio LensArt merupakan studio foto yang menyediakan layanan pemotretan untuk berbagai kebutuhan,
            mulai dari foto personal, couple, keluarga, sahabat, hingga kebutuhan konten media sosial.
            Dengan konsep modern dan suasana studio yang nyaman, pelanggan dapat menikmati pengalaman foto
            yang lebih santai dan menyenangkan.
        </p>
    </div>

    <div class="about-card">
        <h2>Konsep Studio</h2>
        <p>
            Kami mengusung konsep foto yang simpel, elegan, dan kekinian. Setiap paket foto dirancang agar
            pelanggan dapat memilih layanan sesuai kebutuhan, baik untuk sesi singkat maupun sesi foto yang
            lebih fleksibel. Studio LensArt juga mendukung gaya foto yang natural, aesthetic, dan personal.
        </p>
    </div>

    <div class="about-card">
        <h2>Kenapa Pilih LensArt?</h2>
        <ul>
            <li>Pilihan paket foto yang praktis dan terjangkau</li>
            <li>Jadwal reservasi yang lebih mudah diatur</li>
            <li>Hasil foto cocok untuk kenangan maupun media sosial</li>
            <li>Suasana studio nyaman untuk berbagai jenis pelanggan</li>
            <li>Pelayanan ramah dan proses booking yang sederhana</li>
        </ul>
    </div>
</section>

<section class="about-highlight">
    <h2>Abadikan Momenmu Bersama Studio LensArt</h2>
    <p>
        Setiap momen punya cerita. Di Studio LensArt, kami membantu menangkap cerita itu
        melalui foto yang tidak hanya indah dilihat, tetapi juga punya makna untuk dikenang.
    </p>
    <a href="{{ route('dashboard') }}#daftar-booking" class="about-button">Booking Sekarang</a>
</section>

@endsection
