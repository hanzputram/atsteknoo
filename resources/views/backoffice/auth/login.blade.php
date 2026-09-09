<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Backoffice — PT. Anugerah Tama Sejati</title>
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
      --color-border: #E2E8F0;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: var(--font-body);
      background-color: #0F172A;
      background-image: radial-gradient(circle at 50% 20%, #1E293B 0%, #0F172A 100%);
      color: #0F172A;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 24px;
    }

    .login-card {
      background: #FFFFFF;
      border-radius: 24px;
      width: 100%;
      max-width: 440px;
      padding: 40px;
      box-shadow: 0 25px 60px rgba(0, 0, 0, 0.4);
      display: flex;
      flex-direction: column;
      gap: 24px;
    }

    .login-brand-header {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      gap: 8px;
    }

    .login-logo-box {
      width: 52px;
      height: 52px;
      border-radius: 14px;
      background: #0F172A;
      color: #FFFFFF;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 22px;
      font-weight: 800;
      font-family: var(--font-heading);
      box-shadow: 0 8px 20px rgba(15, 23, 42, 0.25);
    }

    .login-brand-title {
      font-size: 20px;
      font-weight: 800;
      font-family: var(--font-heading);
      color: #0F172A;
      letter-spacing: -0.02em;
    }

    .login-brand-subtitle {
      font-size: 13px;
      color: #64748B;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 6px;
      margin-bottom: 16px;
    }

    .form-label {
      font-size: 13px;
      font-weight: 600;
      color: #334155;
    }

    .form-control {
      width: 100%;
      padding: 12px 16px;
      border: 1px solid var(--color-border);
      border-radius: 12px;
      font-size: 14px;
      font-family: inherit;
      color: inherit;
      background: #F8FAFC;
      transition: all 0.2s ease;
    }

    .form-control:focus {
      outline: none;
      background: #FFFFFF;
      border-color: var(--color-primary);
      box-shadow: 0 0 0 3px rgba(225, 29, 72, 0.12);
    }

    .btn-login {
      width: 100%;
      padding: 13px;
      border-radius: 12px;
      background: var(--color-primary);
      color: #FFFFFF;
      font-size: 15px;
      font-weight: 700;
      border: none;
      cursor: pointer;
      font-family: inherit;
      box-shadow: 0 8px 20px rgba(225, 29, 72, 0.25);
      transition: all 0.2s ease;
      margin-top: 8px;
    }

    .btn-login:hover {
      background: var(--color-primary-hover);
      transform: translateY(-2px);
      box-shadow: 0 12px 24px rgba(225, 29, 72, 0.35);
    }

    .alert {
      padding: 12px 14px;
      border-radius: 10px;
      font-size: 13px;
      background: #FEE2E2;
      color: #991B1B;
      border: 1px solid #FECACA;
    }

    .login-footer-hint {
      text-align: center;
      font-size: 12px;
      color: #94A3B8;
      margin-top: 10px;
    }
  </style>
</head>
<body>

  <div class="login-card">
    <div class="login-brand-header">
      <div class="login-logo-box">ATS</div>
      <h1 class="login-brand-title">PT. ANUGERAH TAMA SEJATI</h1>
      <p class="login-brand-subtitle">Masuk ke Backoffice Pengelolaan Katalog</p>
    </div>

    @if($errors->any())
      <div class="alert">
        {{ $errors->first() }}
      </div>
    @endif

    @if(session('success'))
      <div class="alert" style="background: #ECFDF5; color: #065F46; border-color: #A7F3D0;">
        {{ session('success') }}
      </div>
    @endif

    <form action="{{ route('backoffice.login.submit') }}" method="POST">
      @csrf
      <div class="form-group">
        <label class="form-label" for="email">Email Administrator / Editor</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="nama@anugerahtamasejati.com">
      </div>

      <div class="form-group">
        <label class="form-label" for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" required autocomplete="current-password" placeholder="••••••••••••">
      </div>

      <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; font-size: 13px;">
        <label style="display: flex; align-items: center; gap: 6px; cursor: pointer;">
          <input type="checkbox" name="remember">
          <span>Ingat saya</span>
        </label>
      </div>

      <button type="submit" class="btn-login">Masuk ke Backoffice</button>
    </form>

    <div class="login-footer-hint">
      Akses terbatas hanya untuk personel PT. ATS yang berwenang.
    </div>
  </div>

</body>
</html>
