<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Backoffice — PT. Anugerah Tama Sejati</title>
  <meta name="robots" content="noindex, nofollow">

  <!-- Official ATS Brand Favicon (Base64 Instant Data URI + Root-Relative Fallbacks) -->
  <link rel="icon" type="image/png" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAFAklEQVR42r2XX4hUVRzHP797rs3uzpqzWv7BWKgtNAR9MFy1UDMtFrElZPAx7KUe8rVI0KFESZAgKqKXEhKDrYeQzKAyzSwxi6j2QTStlFIZc3fWNWfvPefXw/zuOq3ruOLWgcude+fe8/uez/n9u3DzQwDHOI2xTBQBCjwJ3AGctGtX999/OgTIAfuA34D9wPLxIuLG8H8AFgOrgduBucBU4D4TdsIoZELGlUhs583A98AQkAAlwJuxT4DH6omUalszbvibgI+Bn8zgMWC7kUnsngJfAI9nL2rt3XFx0GXAEeCMGdoBfGa/UzsyGirw9cyrPhKNB/4twLe2Wg9sBCp1K8+OVIzI+8gFhUIJolsl0QzsBX4wI73AtrrVDwuI7DwDqoqoIttsK9yNYrwR/kVAGzDFrg8B8xtNtBomACGB9Qr3AEEbbEXUwPkAHrXzdMN/EugcLYSDndcgAugEaE6RrXI1RG9KQArkgXnAbeYPvZYHWk3MvyYJwEzQB0EDOA8+grVDsEjAX28rogb4FwOTgDvt+iCwoNEk3SB5kCw2I0CQ7TfrAxmulTbPDCNyQ/wtsAn429XC0aXgY1icQrERhdGMt5r3HzURRy0bXuP9WQ5w8EfN6+UtRXQISRPEKxJS5IRCk44SltF1iDwETLScD/ClRcRoIwPwkQBn0M1epOKiKAIkheCgI4FnpfasG0vy2W57nlr+Xw9cGiX5aF0WXBkDOMcQPK+giYvTJHLBIz5F/hqAqUYhaoT/dsN/xCY+DLzYCD9wZu7cuXlVdQCnli5tSjvu/TOAJhCSyCXqYk2Q1xslp+zmKkP+u03+8ojcXy8gATSO47eHi5DqCq/6lVarVb9zp08XLtQEQgo+lWjoyuTJ96uqjEYhw/+KNR0pUAWeAQYb4A/AA6o6K03TD7RuhOzYs0fTrq5EQYfgw9EoZPgnWX0/bAYOUgstHVF6VUSCiGg+nz9//PjxN7z3g6qq3nuvqmnwXkOSaPBeQ02P94cOVXXdOk2WLHkCEbRYdPX4xer5fmu9FHjpevidcwpod3e39vf369mzZ7VaraaqGkIIOnx4r5okiYaQgflR9+17RFVFVaP6fVDr9TxwF3DFhCweLfmo1jqvzs5OTp8+nfb19emlS5dcCEFEJHsmKATiOEakn2p1Azt2LJDlyz8HEJEQ28q94Z9lJTgCvrEs2Gyrj4f3S4QQAoVCgfb2ds6dOxcXCgVyuRxxHNPa2qpRFHkRyd55D9goTU2/mLBIRELmeJEJWGVN5nR7aR/w8AgfGRagqsyePRsR0YsXL4pzjjiO1Tnnc7lcnMvlYusjNojIXjMcAz4zXp/5xAikwN2G/xSwsBH+jo4O+vr6GBgYoFKp+EqlokA8ODh4MUmS54BOEdmrqs5WnYqIjgw9bwLetFVvtUZ0Xq2+UKXWZET1q29ubqZQKFAul2lra0vz+XxcrVYpl8vvDg4ObpoyZcqvJtaJiL9R6s2ahmPAGqsDTwHn6+pBJjQCmDZtGkmSpJVKJW5tbY37+/u/A15YsWLFpyNw+7HkfupKOMAA8Cqwy4Q8bVuTCaFQKMjly5djEblQLpe37N69+7UDBw6kPT09rre3V0UkvdXvgfoQnWgZ8WdLvTp//nzt6up6p1gstmcP9fT0jNtHa72QeASxtS0tLbvmzJmzLLtZKpXi/+MD9RojxWLRlUqlW/oM+wfnQXGspT2xvgAAAABJRU5ErkJggg==">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png?v=ats4">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png?v=ats4">
  <link rel="shortcut icon" href="/favicon.ico?v=ats4">
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png?v=ats4">

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
      width: 60px;
      height: 60px;
      border-radius: 16px;
      background: #FFFFFF;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 10px 25px rgba(15, 23, 42, 0.1);
      border: 1px solid #E2E8F0;
      padding: 8px;
    }

    .login-logo-box img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      display: block;
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
      <div class="login-logo-box">
        <img src="{{ asset('images/ats-logo.webp') }}" alt="PT. Anugerah Tama Sejati Logo">
      </div>
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
