<x-guest-layout>
    <div class="login-header">
        <img src="/img/faizalmotor_logo.png" alt="Faizal Motor 139" class="center-logo">
        <span class="login-badge">FAIZAL MOTOR 139</span>
        <h2 class="login-title">Admin Panel</h2>
        <p class="login-subtitle">
            Selamat Datang Ditampilan Admin
        </p>
    </div>

    @if (session('status'))
        <div class="status-box">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf

        <div class="field">
            <label for="email">Email Admin</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                placeholder="admin@faizalmotor139.com">
            <x-input-error :messages="$errors->get('email')" class="error-list" />
        </div>

        <div class="field">
            <div class="field-row">
                <label for="password" class="field-row-label">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Lupa password?</a>
                @endif
            </div>
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Masukkan password admin">
            <x-input-error :messages="$errors->get('password')" class="error-list" />
        </div>

        <label for="remember_me" class="remember-box">
            <input id="remember_me" type="checkbox" name="remember">
            <span>Tetap masuk di perangkat ini</span>
        </label>

        <div class="button-stack">
            <button type="submit" class="btn-login">Masuk ke Dashboard</button>
            <a href="/" class="btn-back">Kembali ke website</a>
        </div>
    </form>
</x-guest-layout>
