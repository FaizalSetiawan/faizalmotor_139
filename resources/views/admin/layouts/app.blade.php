<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Admin') - Faizal Motor 139</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="/img/faizalmotor_logo.png" type="image/png">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/admin.css">
</head>
<body>

<aside class="sidebar" id="sidebar">
  <div class="sidebar-brand">
    <img src="{{ asset('img/faizalmotor_logo.png') }}" alt="Logo">
    <div>
      <h2>Faizal Motor</h2>
      <small>Admin Panel</small>
    </div>
  </div>

  <nav class="sidebar-nav">
    <div class="nav-label">Menu</div>
    <a href="/admin/dashboard" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
      <span class="icon">📊</span> Dashboard
    </a>

    <div class="nav-label">Data Master</div>
    <a href="/admin/brands" class="nav-link {{ request()->is('admin/brands*') ? 'active' : '' }}">
      <span class="icon">🏭</span> Brands
    </a>
    <a href="/admin/motor-models" class="nav-link {{ request()->is('admin/motor-models*') ? 'active' : '' }}">
      <span class="icon">🏍️</span> Motor Models
    </a>
    <a href="/admin/products" class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}">
      <span class="icon">💡</span> Products
    </a>

    <a href="/admin/sirines" class="nav-link {{ request()->is('admin/sirines*') ? 'active' : '' }}">
      <span class="icon">S</span> Sirine
    </a>

    <div class="nav-label">Interaksi</div>
    <a href="{{ route('admin.contacts.index') }}" class="nav-link {{ request()->is('admin/contacts*') ? 'active' : '' }}">
      <span class="icon">📩</span> Pesan Kontak
    </a>

    <div class="nav-label">Lainnya</div>
    <a href="/" class="nav-link" target="_blank">
      <span class="icon">🌐</span> Lihat Website
    </a>
  </nav>

  <div class="sidebar-footer">
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="logout-button">
        <span>🚪</span> Logout
      </button>
    </form>
  </div>
</aside>

<div class="main">
  <header class="header">
    <h1>@yield('title', 'Dashboard')</h1>
    <div class="header-actions">
      <div class="user-tag">
        <div class="avatar">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</div>
        {{ Auth::user()->name ?? 'Admin' }}
      </div>
    </div>
  </header>

  <div class="content">
    @if(session('success'))
      <div class="alert alert-success">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert alert-error">❌ {{ session('error') }}</div>
    @endif
    @if($errors->any())
      <div class="alert alert-error">❌ {{ $errors->first() }}</div>
    @endif

    @yield('content')
  </div>
</div>

</body>
</html>
