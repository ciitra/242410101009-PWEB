<nav class="navbar">
    <div class="logo">Studio LensArt</div>

    <button class="menu-toggle" id="menuToggle" aria-label="Buka Menu">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <ul class="nav-menu" id="navMenu">
        <li>
            <a href="{{ route('dashboard') }}#beranda" class="{{ request()->routeIs('dashboard') || request()->routeIs('home') ? 'nav-active' : '' }}">
                Beranda
            </a>
        </li>

        <li>
            <a href="{{ route('dashboard') }}#paket">
                Paket Foto
            </a>
        </li>

        <li>
            <a href="{{ route('reservasi.index') }}" class="{{ request()->routeIs('reservasi.*') ? 'nav-active' : '' }}">
                Reservasi
            </a>
        </li>

        <li>
            <a href="{{ route('dashboard') }}#statistik">
                Statistik
            </a>
        </li>

        <li>
            <a href="{{ route('profil.index') }}" class="{{ request()->routeIs('profil.*') ? 'nav-active' : '' }}">
                Profil
            </a>
        </li>

        <li>
            <a href="{{ route('tentang') }}" class="{{ request()->routeIs('tentang') ? 'nav-active' : '' }}">
                Tentang
            </a>
        </li>

        <li>
            <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'nav-active' : '' }}">
                Kontak
            </a>
        </li>
    </ul>
</nav>
