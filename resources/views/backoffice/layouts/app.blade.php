<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard') — ATS Tekno Backoffice</title>
  <meta name="robots" content="noindex, nofollow">

  <!-- Google Fonts: Outfit & Plus Jakarta Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --font-heading: 'Outfit', sans-serif;
      --font-body: 'Plus Jakarta Sans', sans-serif;
      --color-primary: #E11D48;
      --color-primary-hover: #BE123C;
      --color-dark: #0F172A;
      --color-dark-surface: #1E293B;
      --color-bg: #F8FAFC;
      --color-border: #E2E8F0;
      --color-text-main: #0F172A;
      --color-text-muted: #64748B;
      --sidebar-width: 260px;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: var(--font-body);
      background-color: var(--color-bg);
      color: var(--color-text-main);
      display: flex;
      min-height: 100vh;
      -webkit-font-smoothing: antialiased;
    }

    /* Sidebar */
    .admin-sidebar {
      width: var(--sidebar-width);
      background-color: var(--color-dark);
      color: #FFFFFF;
      flex-shrink: 0;
      display: flex;
      flex-direction: column;
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      z-index: 50;
      overflow-y: auto;
    }

    .sidebar-header {
      padding: 24px 20px;
      display: flex;
      align-items: center;
      gap: 12px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      text-decoration: none;
      color: inherit;
    }

    .sidebar-logo {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      background: rgba(255, 255, 255, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 800;
      color: #FFFFFF;
      font-family: var(--font-heading);
      border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .sidebar-title-wrap h2 {
      font-size: 15px;
      font-weight: 700;
      letter-spacing: -0.01em;
      font-family: var(--font-heading);
      color: #FFFFFF;
      line-height: 1.2;
    }

    .sidebar-title-wrap span {
      font-size: 11px;
      color: #94A3B8;
      letter-spacing: 0.1em;
      text-transform: uppercase;
    }

    .sidebar-nav {
      padding: 16px 12px;
      display: flex;
      flex-direction: column;
      gap: 4px;
      flex: 1;
    }

    .nav-group-label {
      font-size: 11px;
      font-weight: 700;
      color: #64748B;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      padding: 14px 12px 6px 12px;
    }

    .nav-link {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px 14px;
      border-radius: 10px;
      color: #CBD5E1;
      text-decoration: none;
      font-size: 13.5px;
      font-weight: 500;
      transition: all 0.2s ease;
    }

    .nav-link:hover {
      background: rgba(255, 255, 255, 0.08);
      color: #FFFFFF;
    }

    .nav-link.active {
      background: var(--color-primary);
      color: #FFFFFF;
      font-weight: 600;
    }

    .nav-link .nav-icon {
      font-size: 16px;
      width: 20px;
      text-align: center;
    }

    .sidebar-footer {
      padding: 16px;
      border-top: 1px solid rgba(255, 255, 255, 0.08);
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .user-pill {
      display: flex;
      flex-direction: column;
    }

    .user-name {
      font-size: 13px;
      font-weight: 600;
      color: #FFFFFF;
    }

    .user-role {
      font-size: 11px;
      color: #94A3B8;
      text-transform: capitalize;
    }

    /* Main Content Wrapper */
    .admin-main {
      margin-left: var(--sidebar-width);
      flex: 1;
      display: flex;
      flex-direction: column;
      min-width: 0;
    }

    /* Topbar */
    .admin-topbar {
      height: 68px;
      background: #FFFFFF;
      border-bottom: 1px solid var(--color-border);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 32px;
      position: sticky;
      top: 0;
      z-index: 40;
    }

    .breadcrumb {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 13px;
      color: var(--color-text-muted);
    }

    .breadcrumb a {
      color: inherit;
      text-decoration: none;
    }

    .breadcrumb a:hover {
      color: var(--color-primary);
    }

    .topbar-actions {
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .btn-view-site {
      font-size: 12.5px;
      font-weight: 600;
      color: #0F172A;
      background: #F1F5F9;
      padding: 8px 14px;
      border-radius: 8px;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: all 0.2s ease;
    }

    .btn-view-site:hover {
      background: #E2E8F0;
    }

    .btn-logout {
      background: transparent;
      border: none;
      color: #DC2626;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 12px;
      border-radius: 8px;
      transition: all 0.2s ease;
    }

    .btn-logout:hover {
      background: #FEE2E2;
    }

    /* Content Area */
    .admin-content {
      padding: 32px;
      display: flex;
      flex-direction: column;
      gap: 24px;
      flex: 1;
    }

    /* Alerts */
    .alert {
      padding: 14px 18px;
      border-radius: 12px;
      font-size: 13.5px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
    }

    .alert-success {
      background: #ECFDF5;
      color: #065F46;
      border: 1px solid #A7F3D0;
    }

    .alert-danger {
      background: #FEF2F2;
      color: #991B1B;
      border: 1px solid #FECACA;
    }

    .alert-info {
      background: #EFF6FF;
      color: #1E40AF;
      border: 1px solid #BFDBFE;
    }

    /* Page Header */
    .page-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 16px;
    }

    .page-title {
      font-size: 24px;
      font-weight: 700;
      font-family: var(--font-heading);
      letter-spacing: -0.02em;
    }

    .page-subtitle {
      font-size: 13.5px;
      color: var(--color-text-muted);
      margin-top: 4px;
    }

    /* Card Panels */
    .panel-card {
      background: #FFFFFF;
      border-radius: 16px;
      border: 1px solid var(--color-border);
      box-shadow: 0 4px 14px rgba(0, 0, 0, 0.02);
      overflow: hidden;
    }

    .panel-body {
      padding: 24px;
    }

    /* Standard Button Styles */
    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      padding: 10px 18px;
      border-radius: 10px;
      font-size: 14px;
      font-weight: 600;
      text-decoration: none;
      cursor: pointer;
      border: 1px solid transparent;
      transition: all 0.2s ease;
      font-family: var(--font-body);
    }

    .btn-primary {
      background: var(--color-primary);
      color: #FFFFFF;
    }

    .btn-primary:hover {
      background: var(--color-primary-hover);
      transform: translateY(-1px);
    }

    .btn-secondary {
      background: #F1F5F9;
      color: #334155;
      border-color: #CBD5E1;
    }

    .btn-secondary:hover {
      background: #E2E8F0;
    }

    .btn-danger {
      background: #DC2626;
      color: #FFFFFF;
    }

    .btn-danger:hover {
      background: #B91C1C;
    }

    .btn-sm {
      padding: 6px 12px;
      font-size: 12.5px;
      border-radius: 7px;
    }

    /* Tables */
    .table-responsive {
      width: 100%;
      overflow-x: auto;
    }

    .data-table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
      font-size: 13.5px;
    }

    .data-table th {
      background: #F8FAFC;
      color: #475569;
      font-weight: 700;
      padding: 14px 16px;
      border-bottom: 1px solid var(--color-border);
      font-size: 12px;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }

    .data-table td {
      padding: 14px 16px;
      border-bottom: 1px solid var(--color-border);
      color: #1E293B;
      vertical-align: middle;
    }

    .data-table tr:hover td {
      background-color: #F8FAFC;
    }

    /* Badges */
    .badge {
      display: inline-flex;
      align-items: center;
      padding: 3px 8px;
      border-radius: 6px;
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.04em;
    }

    .badge-success { background: #ECFDF5; color: #059669; }
    .badge-warning { background: #FEF3C7; color: #D97706; }
    .badge-danger { background: #FEE2E2; color: #DC2626; }
    .badge-neutral { background: #F1F5F9; color: #475569; }
    .badge-info { background: #EFF6FF; color: #2563EB; }

    /* Forms */
    .form-group {
      margin-bottom: 20px;
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .form-label {
      font-size: 13px;
      font-weight: 600;
      color: #334155;
    }

    .form-control {
      width: 100%;
      padding: 10px 14px;
      border: 1px solid var(--color-border);
      border-radius: 10px;
      font-size: 14px;
      font-family: inherit;
      color: inherit;
      background: #FFFFFF;
      transition: border-color 0.2s ease;
    }

    .form-control:focus {
      outline: none;
      border-color: var(--color-primary);
      box-shadow: 0 0 0 3px rgba(225, 29, 72, 0.1);
    }

    .form-hint {
      font-size: 12px;
      color: var(--color-text-muted);
    }

    .form-error {
      font-size: 12px;
      color: #DC2626;
      font-weight: 500;
    }
  </style>
  @stack('styles')
</head>
<body>

  <!-- Admin Sidebar Navigation -->
  <aside class="admin-sidebar">
    <a href="{{ route('backoffice.dashboard') }}" class="sidebar-header">
      <div class="sidebar-logo">ATS</div>
      <div class="sidebar-title-wrap">
        <h2>ATS TEKNO</h2>
        <span>Backoffice Admin</span>
      </div>
    </a>

    <nav class="sidebar-nav">
      <a href="{{ route('backoffice.dashboard') }}" class="nav-link {{ request()->routeIs('backoffice.dashboard') ? 'active' : '' }}">
        <span class="nav-icon">📊</span>
        <span>Dashboard</span>
      </a>

      <div class="nav-group-label">Katalog Produk</div>
      <a href="{{ route('backoffice.products.index') }}" class="nav-link {{ request()->routeIs('backoffice.products.*') ? 'active' : '' }}">
        <span class="nav-icon">⚡</span>
        <span>Master Produk</span>
      </a>
      <a href="{{ route('backoffice.product-categories.index') }}" class="nav-link {{ request()->routeIs('backoffice.product-categories.*') ? 'active' : '' }}">
        <span class="nav-icon">📁</span>
        <span>Kategori Produk</span>
      </a>
      <a href="{{ route('backoffice.brands.index') }}" class="nav-link {{ request()->routeIs('backoffice.brands.*') ? 'active' : '' }}">
        <span class="nav-icon">🏷️</span>
        <span>Brand Resmi</span>
      </a>
      <a href="{{ route('backoffice.import.index') }}" class="nav-link {{ request()->routeIs('backoffice.import.*') ? 'active' : '' }}">
        <span class="nav-icon">📥</span>
        <span>Import Center (Excel)</span>
      </a>

      <div class="nav-group-label">Portofolio & Konten</div>
      <a href="{{ route('backoffice.projects.index') }}" class="nav-link {{ request()->routeIs('backoffice.projects.*') ? 'active' : '' }}">
        <span class="nav-icon">🏗️</span>
        <span>Project Portofolio</span>
      </a>
      <a href="{{ route('backoffice.project-categories.index') }}" class="nav-link {{ request()->routeIs('backoffice.project-categories.*') ? 'active' : '' }}">
        <span class="nav-icon">📑</span>
        <span>Kategori Project</span>
      </a>
      <a href="{{ route('backoffice.articles.index') }}" class="nav-link {{ request()->routeIs('backoffice.articles.*') ? 'active' : '' }}">
        <span class="nav-icon">📰</span>
        <span>Artikel & Panduan</span>
      </a>
      <a href="{{ route('backoffice.article-categories.index') }}" class="nav-link {{ request()->routeIs('backoffice.article-categories.*') ? 'active' : '' }}">
        <span class="nav-icon">🏷️</span>
        <span>Kategori Artikel</span>
      </a>
      <a href="{{ route('backoffice.pages.index') }}" class="nav-link {{ request()->routeIs('backoffice.pages.*') ? 'active' : '' }}">
        <span class="nav-icon">📄</span>
        <span>Halaman Perusahaan</span>
      </a>

      <div class="nav-group-label">Inbox & Operasional</div>
      <a href="{{ route('backoffice.inquiries.index') }}" class="nav-link {{ request()->routeIs('backoffice.inquiries.*') ? 'active' : '' }}">
        <span class="nav-icon">💬</span>
        <span>Pesan Masuk</span>
      </a>

      @if(auth()->user()->isAdmin())
        <div class="nav-group-label">Pengaturan Sistem</div>
        <a href="{{ route('backoffice.settings.index') }}" class="nav-link {{ request()->routeIs('backoffice.settings.*') ? 'active' : '' }}">
          <span class="nav-icon">⚙️</span>
          <span>Pengaturan Website</span>
        </a>
        <a href="{{ route('backoffice.users.index') }}" class="nav-link {{ request()->routeIs('backoffice.users.*') ? 'active' : '' }}">
          <span class="nav-icon">👥</span>
          <span>Pengguna & Role</span>
        </a>
      @endif
    </nav>

    <div class="sidebar-footer">
      <div class="user-pill">
        <span class="user-name">{{ auth()->user()->name }}</span>
        <span class="user-role">{{ auth()->user()->role }}</span>
      </div>
      <a href="{{ route('backoffice.password') }}" title="Ganti Password" style="color: #94A3B8; text-decoration: none; font-size: 16px;">🔑</a>
    </div>
  </aside>

  <!-- Main Content Area -->
  <div class="admin-main">
    <header class="admin-topbar">
      <div class="breadcrumb">
        <a href="{{ route('backoffice.dashboard') }}">Backoffice</a>
        <span>/</span>
        <span>@yield('breadcrumb', 'Dashboard')</span>
      </div>

      <div class="topbar-actions">
        <a href="{{ route('home') }}" target="_blank" class="btn-view-site">
          <span>Website Publik</span>
          <span>&nearr;</span>
        </a>

        <form action="{{ route('backoffice.logout') }}" method="POST" style="margin: 0;">
          @csrf
          <button type="submit" class="btn-logout" onclick="return confirm('Apakah Anda yakin ingin keluar?')">
            <span>Keluar</span>
          </button>
        </form>
      </div>
    </header>

    <main class="admin-content">
      <!-- Session Feedback Notifications -->
      @if(session('success'))
        <div class="alert alert-success">
          <span>{{ session('success') }}</span>
          <button type="button" onclick="this.parentElement.remove()" style="background: none; border: none; cursor: pointer; color: inherit;">&times;</button>
        </div>
      @endif

      @if(session('info'))
        <div class="alert alert-info">
          <span>{{ session('info') }}</span>
          <button type="button" onclick="this.parentElement.remove()" style="background: none; border: none; cursor: pointer; color: inherit;">&times;</button>
        </div>
      @endif

      @if($errors->any())
        <div class="alert alert-danger">
          <ul style="margin-left: 18px;">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
          <button type="button" onclick="this.parentElement.remove()" style="background: none; border: none; cursor: pointer; color: inherit;">&times;</button>
        </div>
      @endif

      @yield('content')
    </main>
  </div>

  @stack('scripts')
</body>
</html>
