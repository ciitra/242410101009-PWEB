<nav class="navbar">
    <div class="logo">Studio LensArt</div>

    <button class="menu-toggle" id="menuToggle" aria-label="Buka Menu">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <ul class="nav-menu" id="navMenu">
        <li><a href="{{ route('dashboard') }}#beranda">Beranda</a></li>
        <li><a href="{{ route('dashboard') }}#paket">Paket Foto</a></li>
        <li><a href="{{ route('dashboard') }}#daftar-booking">Data Reservasi</a></li>
        <li><a href="{{ route('dashboard') }}#statistik">Statistik</a></li>
        <li><a href="{{ route('tentang') }}">Tentang</a></li>
        <li><a href="{{ route('kontak') }}">Kontak</a></li>
    </ul>
</nav>
