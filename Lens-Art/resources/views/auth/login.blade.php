<x-guest-layout>
    <div class="auth-card">
        <div class="auth-brand">
            <img src="{{ asset('images/logo-lensart.png') }}" alt="Logo Studio LensArt">
            <h1>Login Owner</h1>
            <p>Masuk ke dashboard Studio LensArt untuk mengelola data reservasi pelanggan.</p>
        </div>

        @if (session('status'))
            <div class="auth-alert success">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="auth-alert error">
                <strong>Login belum berhasil.</strong>
                <p>Periksa kembali email dan password yang digunakan.</p>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf

            <div class="auth-form-group">
                <label for="email">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="Masukkan email owner"
                    class="{{ $errors->has('email') ? 'input-error' : '' }}"
                >
                @error('email')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>

            <div class="auth-form-group">
                <label for="password">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="Masukkan password"
                    class="{{ $errors->has('password') ? 'input-error' : '' }}"
                >
                @error('password')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>

            <div class="auth-options">
                <label class="auth-remember">
                    <input type="checkbox" name="remember">
                    <span>Ingat saya</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                @endif
            </div>

            <button type="submit" class="auth-submit">
                Login
            </button>

            <p class="auth-switch">
                Belum punya akun?
                <a href="{{ route('register') }}">Daftar di sini</a>
            </p>
        </form>
    </div>
</x-guest-layout>
