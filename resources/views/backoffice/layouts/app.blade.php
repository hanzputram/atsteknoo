<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard') — ATS Tekno Backoffice</title>
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

  <!-- Tailwind CSS CDN for Modern Utility Layouts -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            outfit: ['Outfit', 'sans-serif'],
            sans: ['Plus Jakarta Sans', 'sans-serif'],
          },
          colors: {
            ats: {
              red: '#E11D48',
              dark: '#0F172A',
              navy: '#001D34',
              surface: '#F8FAFC',
            }
          }
        }
      }
    }
  </script>

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
      height: 100vh;
      max-height: 100vh;
      z-index: 50;
      overflow: hidden;
    }

    .sidebar-header {
      padding: 22px 20px;
      display: flex;
      align-items: center;
      gap: 12px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      text-decoration: none;
      color: inherit;
      flex-shrink: 0;
    }

    .sidebar-logo {
      width: 42px;
      height: 42px;
      border-radius: 10px;
      background: #FFFFFF;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid rgba(255, 255, 255, 0.2);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      padding: 6px;
      flex-shrink: 0;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .sidebar-logo img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      display: block;
    }

    .sidebar-header a:hover .sidebar-logo {
      transform: scale(1.05);
      box-shadow: 0 6px 16px rgba(225, 29, 72, 0.3);
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
      padding: 14px 12px;
      display: flex;
      flex-direction: column;
      gap: 3px;
      flex: 1;
      min-height: 0;
      overflow-y: auto;
      overflow-x: hidden;
    }

    .sidebar-nav::-webkit-scrollbar {
      width: 4px;
    }

    .sidebar-nav::-webkit-scrollbar-track {
      background: transparent;
    }

    .sidebar-nav::-webkit-scrollbar-thumb {
      background: rgba(255, 255, 255, 0.18);
      border-radius: 4px;
    }

    .nav-group-label {
      font-size: 10.5px;
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
      padding: 9px 12px;
      border-radius: 9px;
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
      width: 20px;
      height: 20px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      color: inherit;
    }

    .nav-link .nav-icon svg {
      width: 18px;
      height: 18px;
      stroke-width: 2;
    }

    .sidebar-footer {
      padding: 14px 18px;
      border-top: 1px solid rgba(255, 255, 255, 0.08);
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-shrink: 0;
      background: #0B1120;
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
      min-height: 100vh;
      background-color: var(--color-bg);
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
      box-sizing: border-box;
    }

    input[type="text"], input[type="email"], input[type="password"], input[type="number"], input[type="url"], input[type="file"], select, textarea {
      font-family: inherit;
      font-size: 13.5px;
      color: var(--color-text-main);
      border: 1px solid var(--color-border);
      border-radius: 10px;
      padding: 10px 14px;
      background: #FFFFFF;
      width: 100%;
      box-sizing: border-box;
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .form-control:focus, input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus, input[type="number"]:focus, input[type="url"]:focus, select:focus, textarea:focus {
      outline: none;
      border-color: var(--color-primary);
      box-shadow: 0 0 0 3px rgba(225, 29, 72, 0.12);
    }

    input[type="checkbox"], input[type="radio"] {
      width: auto;
      cursor: pointer;
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

    /* SVG Global Constraints */
    svg {
      max-width: 100%;
      max-height: 100%;
      vertical-align: middle;
    }
    svg.w-3, .w-3 { width: 12px !important; }
    svg.h-3, .h-3 { height: 12px !important; }
    svg.w-3\.5, .w-3\.5 { width: 14px !important; }
    svg.h-3\.5, .h-3\.5 { height: 14px !important; }
    svg.w-4, .w-4 { width: 16px !important; }
    svg.h-4, .h-4 { height: 16px !important; }
    svg.w-5, .w-5 { width: 20px !important; }
    svg.h-5, .h-5 { height: 20px !important; }
    svg.w-6, .w-6 { width: 24px !important; }
    svg.h-6, .h-6 { height: 24px !important; }

    /* Utility & Helper Classes */
    .grid { display: grid; }
    .grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)); }
    .grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    .grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }

    @media (min-width: 640px) {
      .sm\:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
      .sm\:flex-row { flex-direction: row; }
      .sm\:items-center { align-items: center; }
      .sm\:p-8 { padding: 32px; }
    }

    @media (min-width: 768px) {
      .md\:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
      .md\:grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
      .md\:grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
    }

    .gap-2 { gap: 8px; }
    .gap-3 { gap: 12px; }
    .gap-4 { gap: 16px; }
    .gap-6 { gap: 24px; }
    .gap-8 { gap: 32px; }

    .space-y-2 > * + * { margin-top: 8px; }
    .space-y-3 > * + * { margin-top: 12px; }
    .space-y-4 > * + * { margin-top: 16px; }
    .space-y-5 > * + * { margin-top: 20px; }
    .space-y-6 > * + * { margin-top: 24px; }
    .space-y-8 > * + * { margin-top: 32px; }

    .space-x-2 > * + * { margin-left: 8px; }
    .space-x-3 > * + * { margin-left: 12px; }

    .max-w-4xl { max-width: 896px; }
    .max-w-3xl { max-width: 768px; }
    .max-w-2xl { max-width: 672px; }
    .max-w-xl { max-width: 576px; }
    .max-w-md { max-width: 448px; }
    .mx-auto { margin-left: auto; margin-right: auto; }

    .w-full { width: 100%; }
    .h-full { height: 100%; }
    .w-12 { width: 48px; }
    .h-16 { height: 64px; }
    .w-16 { width: 64px; }
    .w-20 { width: 80px; }
    .h-28 { height: 112px; }

    .flex { display: flex; }
    .inline-flex { display: inline-flex; }
    .flex-col { flex-direction: column; }
    .items-center { align-items: center; }
    .items-start { align-items: flex-start; }
    .justify-between { justify-content: space-between; }
    .justify-center { justify-content: center; }
    .justify-end { justify-content: flex-end; }
    .flex-1 { flex: 1; }
    .shrink-0 { flex-shrink: 0; }

    .overflow-hidden { overflow: hidden; }
    .rounded-lg { border-radius: 8px; }
    .rounded-xl { border-radius: 12px; }
    .rounded-2xl { border-radius: 16px; }
    .rounded-full { border-radius: 9999px; }

    .border { border: 1px solid var(--color-border); }
    .border-b { border-bottom: 1px solid var(--color-border); }
    .border-t { border-top: 1px solid var(--color-border); }

    .bg-white { background-color: #FFFFFF; }
    .bg-slate-50 { background-color: #F8FAFC; }
    .bg-slate-100 { background-color: #F1F5F9; }
    .bg-slate-200 { background-color: #E2E8F0; }

    .text-slate-900 { color: #0F172A; }
    .text-slate-800 { color: #1E293B; }
    .text-slate-700 { color: #334155; }
    .text-slate-600 { color: #475569; }
    .text-slate-500 { color: #64748B; }
    .text-slate-400 { color: #94A3B8; }
    .text-blue-600 { color: #2563EB; }
    .text-red-500 { color: #EF4444; }
    .text-emerald-600 { color: #059669; }

    .font-bold { font-weight: 700; }
    .font-semibold { font-weight: 600; }
    .font-medium { font-weight: 500; }
    .font-mono { font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace; }

    .text-xs { font-size: 12px; }
    .text-sm { font-size: 13.5px; }
    .text-base { font-size: 14px; }
    .text-lg { font-size: 18px; }
    .text-xl { font-size: 20px; font-weight: 700; }
    .text-2xl { font-size: 24px; font-weight: 700; }

    .uppercase { text-transform: uppercase; }
    .tracking-wider { letter-spacing: 0.05em; }
    .cursor-pointer { cursor: pointer; }
    .shadow-sm { box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); }
    .shadow-md { box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); }
    .object-cover { object-fit: cover; }
    .object-contain { object-fit: contain; }
    .block { display: block; }
    .inline-block { display: inline-block; }
    .text-right { text-align: right; }
    .text-center { text-align: center; }

    .p-3 { padding: 12px; }
    .p-4 { padding: 16px; }
    .p-6 { padding: 24px; }
    .px-4 { padding-left: 16px; padding-right: 16px; }
    .py-2 { padding-top: 8px; padding-bottom: 8px; }
    .py-2\.5 { padding-top: 10px; padding-bottom: 10px; }
    .pb-2 { padding-bottom: 8px; }
    .pb-3 { padding-bottom: 12px; }
    .pb-4 { padding-bottom: 16px; }
    .pt-4 { padding-top: 16px; }
    .mt-0\.5 { margin-top: 2px; }
    .mt-1 { margin-top: 4px; }
    .mt-2 { margin-top: 8px; }
    .mt-4 { margin-top: 16px; }
    .mb-1 { margin-bottom: 4px; }
    .mb-1\.5 { margin-bottom: 6px; }
    .mb-2 { margin-bottom: 8px; }
    .mb-4 { margin-bottom: 16px; }
    .mb-6 { margin-bottom: 24px; }

    /* Responsive Admin Navigation & Off-Canvas Sidebar */
    .btn-sidebar-toggle {
      display: none;
      width: 38px;
      height: 38px;
      border-radius: 9px;
      background: #F1F5F9;
      border: 1px solid #CBD5E1;
      color: #0F172A;
      cursor: pointer;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      transition: all 0.2s ease;
    }

    .btn-sidebar-toggle:hover {
      background: #E2E8F0;
      color: var(--color-primary);
    }

    .sidebar-close-btn {
      display: none;
      width: 32px;
      height: 32px;
      border-radius: 8px;
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      color: #FFFFFF;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      margin-left: auto;
      font-size: 20px;
      line-height: 1;
      transition: all 0.2s ease;
    }

    .sidebar-close-btn:hover {
      background: var(--color-primary);
      border-color: var(--color-primary);
    }

    .admin-backdrop {
      position: fixed;
      inset: 0;
      background: rgba(15, 23, 42, 0.65);
      backdrop-filter: blur(4px);
      -webkit-backdrop-filter: blur(4px);
      z-index: 9998;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.3s ease;
    }

    .admin-backdrop.active {
      opacity: 1;
      pointer-events: auto;
    }

    @media (max-width: 1024px) {
      .admin-sidebar {
        transform: translateX(-100%);
        transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        z-index: 9999;
        box-shadow: 10px 0 35px rgba(0, 0, 0, 0.4);
      }

      .admin-sidebar.open {
        transform: translateX(0);
      }

      .btn-sidebar-toggle {
        display: inline-flex;
      }

      .sidebar-close-btn {
        display: inline-flex;
      }

      .admin-main {
        margin-left: 0 !important;
        width: 100% !important;
        transition: none;
      }

      .admin-topbar {
        padding: 0 20px;
        height: 62px;
      }

      .admin-content {
        padding: 20px 16px;
      }
    }

    @media (max-width: 640px) {
      .admin-topbar {
        padding: 0 12px;
        height: 56px;
      }

      .breadcrumb {
        font-size: 12px;
      }

      .breadcrumb span:last-child {
        max-width: 120px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: inline-block;
        vertical-align: bottom;
      }

      .btn-view-site {
        padding: 6px 10px;
        font-size: 11.5px;
      }

      .btn-view-site span:first-child {
        display: none;
      }

      .btn-view-site::before {
        content: 'Web ';
      }

      .btn-logout {
        padding: 6px 8px;
        font-size: 12px;
      }

      .admin-content {
        padding: 16px 12px;
        gap: 16px;
      }

      .page-title {
        font-size: 19px;
      }

      .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
      }
    }

    /* Live Chat Real-Time Floating Alert Banner */
    .livechat-floating-banner {
      background: linear-gradient(135deg, #0F172A 0%, #1E1B4B 100%);
      border-bottom: 2px solid #FC0001;
      box-shadow: 0 10px 25px -5px rgba(252, 0, 1, 0.25), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
      padding: 12px 24px;
      position: sticky;
      top: 60px;
      z-index: 45;
      animation: slideDownAlert 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }
    @keyframes slideDownAlert {
      from { transform: translateY(-100%); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }
    .livechat-floating-banner .banner-inner {
      max-width: 1400px;
      margin: 0 auto;
      display: flex;
      align-items: center;
      gap: 16px;
      color: #FFFFFF;
    }
    .banner-glow-icon {
      position: relative;
      width: 40px;
      height: 40px;
      border-radius: 12px;
      background: #FC0001;
      color: #FFFFFF;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      box-shadow: 0 0 15px rgba(252, 0, 1, 0.6);
    }
    .pulse-wave {
      position: absolute;
      inset: -4px;
      border-radius: 16px;
      border: 2px solid #FC0001;
      animation: pulseAlert 1.5s infinite;
      pointer-events: none;
    }
    @keyframes pulseAlert {
      0% { transform: scale(0.95); opacity: 0.9; }
      100% { transform: scale(1.3); opacity: 0; }
    }
    .banner-info {
      flex: 1;
      min-width: 0;
    }
    .banner-headline {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 2px;
      flex-wrap: wrap;
    }
    .badge-live-chat {
      font-size: 10px;
      font-weight: 800;
      background: #FC0001;
      color: #FFFFFF;
      padding: 2px 6px;
      border-radius: 6px;
      letter-spacing: 0.05em;
    }
    .visitor-name {
      font-weight: 700;
      font-size: 13.5px;
      color: #F8FAFC;
    }
    .chat-time {
      font-size: 11px;
      color: #94A3B8;
    }
    .message-snippet {
      font-size: 12.5px;
      color: #CBD5E1;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      max-width: 700px;
    }
    .banner-cta {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-shrink: 0;
    }
    .btn-open-chat {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: #FC0001;
      color: #FFFFFF;
      font-weight: 700;
      font-size: 12.5px;
      padding: 8px 16px;
      border-radius: 10px;
      text-decoration: none;
      transition: all 0.2s;
      box-shadow: 0 2px 8px rgba(252, 0, 1, 0.4);
    }
    .btn-open-chat:hover {
      background: #D80001;
      transform: translateY(-1px);
    }
    .btn-close-banner {
      background: rgba(255, 255, 255, 0.1);
      border: none;
      color: #94A3B8;
      width: 32px;
      height: 32px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      cursor: pointer;
      transition: all 0.2s;
    }
    .btn-close-banner:hover {
      background: rgba(255, 255, 255, 0.2);
      color: #FFFFFF;
    }
    .btn-notif-toggle {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 12px;
      font-weight: 600;
      padding: 6px 12px;
      border-radius: 8px;
      border: 1px solid var(--color-border);
      background: #FFFFFF;
      color: var(--color-text-muted);
      cursor: pointer;
      transition: all 0.2s;
    }
    .btn-notif-toggle:hover {
      border-color: #CBD5E1;
      color: var(--color-text-main);
    }
    .btn-notif-toggle.is-active {
      background: #F0FDF4;
      border-color: #86EFAC;
      color: #15803D;
    }
  </style>
  @stack('styles')
</head>
<body>

  <!-- Backdrop for Mobile Admin Sidebar -->
  <div class="admin-backdrop" id="adminSidebarBackdrop" onclick="closeAdminSidebar()"></div>

  <!-- Admin Sidebar Navigation -->
  <aside class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-header" style="justify-content: space-between;">
      <a href="{{ auth()->user()->isAdmin() ? route('backoffice.dashboard') : (auth()->user()->isEditor() ? route('backoffice.products.index') : route('backoffice.live-chats.index')) }}" style="display: flex; align-items: center; gap: 12px; text-decoration: none; color: inherit; min-width: 0;">
        <div class="sidebar-logo">
          <img src="{{ asset('images/ats-logo.png') }}" alt="PT. Anugerah Tama Sejati Logo">
        </div>
        <div class="sidebar-title-wrap">
          <h2>ATS TEKNO</h2>
          <span>Backoffice Admin</span>
        </div>
      </a>
      <button type="button" class="sidebar-close-btn" onclick="closeAdminSidebar()" aria-label="Tutup Menu">&times;</button>
    </div>

    <nav class="sidebar-nav">
      @if(auth()->user()->isAdmin())
        <a href="{{ route('backoffice.dashboard') }}" class="nav-link {{ request()->routeIs('backoffice.dashboard') ? 'active' : '' }}">
          <span class="nav-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
          </span>
          <span>Dashboard</span>
        </a>
      @endif

      @if(auth()->user()->canManageCatalog())
        <div class="nav-group-label">Katalog Produk</div>
        <a href="{{ route('backoffice.products.index') }}" class="nav-link {{ request()->routeIs('backoffice.products.*') ? 'active' : '' }}">
          <span class="nav-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
          </span>
          <span>Master Produk</span>
        </a>
        <a href="{{ route('backoffice.product-categories.index') }}" class="nav-link {{ request()->routeIs('backoffice.product-categories.*') ? 'active' : '' }}">
          <span class="nav-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
          </span>
          <span>Kategori Produk</span>
        </a>
        <a href="{{ route('backoffice.brands.index') }}" class="nav-link {{ request()->routeIs('backoffice.brands.*') ? 'active' : '' }}">
          <span class="nav-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
          </span>
          <span>Brand Resmi</span>
        </a>
        <a href="{{ route('backoffice.import.index') }}" class="nav-link {{ request()->routeIs('backoffice.import.*') ? 'active' : '' }}">
          <span class="nav-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
          </span>
          <span>Import Center (Excel)</span>
        </a>

        <div class="nav-group-label">Portofolio & Konten</div>
        <a href="{{ route('backoffice.projects.index') }}" class="nav-link {{ request()->routeIs('backoffice.projects.*') ? 'active' : '' }}">
          <span class="nav-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
          </span>
          <span>Project Portofolio</span>
        </a>
        <a href="{{ route('backoffice.project-categories.index') }}" class="nav-link {{ request()->routeIs('backoffice.project-categories.*') ? 'active' : '' }}">
          <span class="nav-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
          </span>
          <span>Kategori Project</span>
        </a>
        <a href="{{ route('backoffice.articles.index') }}" class="nav-link {{ request()->routeIs('backoffice.articles.*') ? 'active' : '' }}">
          <span class="nav-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
          </span>
          <span>Artikel & Panduan</span>
        </a>
        <a href="{{ route('backoffice.article-categories.index') }}" class="nav-link {{ request()->routeIs('backoffice.article-categories.*') ? 'active' : '' }}">
          <span class="nav-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
          </span>
          <span>Kategori Artikel</span>
        </a>
        <a href="{{ route('backoffice.pages.index') }}" class="nav-link {{ request()->routeIs('backoffice.pages.*') ? 'active' : '' }}">
          <span class="nav-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
          </span>
          <span>Halaman Perusahaan</span>
        </a>
        <a href="{{ route('backoffice.certificates.index') }}" class="nav-link {{ request()->routeIs('backoffice.certificates.*') ? 'active' : '' }}">
          <span class="nav-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
          </span>
          <span>Master Sertifikat</span>
        </a>
      @endif

      @if(auth()->user()->canManageInbox())
        <div class="nav-group-label">Inbox & Operasional</div>
        <a href="{{ route('backoffice.live-chats.index') }}" class="nav-link {{ request()->routeIs('backoffice.live-chats.*') ? 'active' : '' }}">
          <span class="nav-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
          </span>
          <span style="flex:1;">Live Chat</span>
          @php
            $sidebarLiveChatUnread = \App\Models\LiveChatSession::where('is_archived', false)->where('status', 'unread')->count();
          @endphp
          <span id="sidebarLiveChatBadge" style="{{ $sidebarLiveChatUnread > 0 ? '' : 'display: none;' }} background-color: #FC0001; color: #FFFFFF; font-size: 10px; font-weight: 800; padding: 2px 7px; border-radius: 9999px;">{{ $sidebarLiveChatUnread }}</span>
        </a>
        <a href="{{ route('backoffice.inquiries.index') }}" class="nav-link {{ request()->routeIs('backoffice.inquiries.*') ? 'active' : '' }}">
          <span class="nav-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
          </span>
          <span style="flex:1;">Pesan Masuk</span>
          @php
            $sidebarInquiryUnread = \App\Models\ContactInquiry::where('status', 'unread')->count();
          @endphp
          <span id="sidebarInquiryBadge" style="{{ $sidebarInquiryUnread > 0 ? '' : 'display: none;' }} background-color: #2563EB; color: #FFFFFF; font-size: 10px; font-weight: 800; padding: 2px 7px; border-radius: 9999px;">{{ $sidebarInquiryUnread }}</span>
        </a>
        <a href="{{ route('backoffice.ai-knowledge.index') }}" class="nav-link {{ request()->routeIs('backoffice.ai-knowledge.*') ? 'active' : '' }}">
          <span class="nav-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
          </span>
          <span style="flex:1;">Pengetahuan & Memori AI</span>
          @php
            $sidebarAiKnowledgeCount = \App\Models\AiKnowledge::where('is_active', true)->count();
          @endphp
          <span style="background-color: rgba(255, 255, 255, 0.15); color: #E2E8F0; font-size: 10px; font-weight: 700; padding: 2px 7px; border-radius: 9999px;">{{ $sidebarAiKnowledgeCount }}</span>
        </a>
      @endif

      @if(auth()->user()->isAdmin())
        <div class="nav-group-label">Pengaturan Sistem</div>
        <a href="{{ route('backoffice.settings.index') }}" class="nav-link {{ request()->routeIs('backoffice.settings.*') ? 'active' : '' }}">
          <span class="nav-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
          </span>
          <span>Pengaturan Website</span>
        </a>
        <a href="{{ route('backoffice.users.index') }}" class="nav-link {{ request()->routeIs('backoffice.users.*') ? 'active' : '' }}">
          <span class="nav-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
          </span>
          <span>Pengguna & Role</span>
        </a>
      @endif
    </nav>

    <div class="sidebar-footer">
      <div class="user-pill">
        <span class="user-name">{{ auth()->user()->name }}</span>
        <span class="user-role">{{ auth()->user()->role_label }}</span>
      </div>
      <a href="{{ route('backoffice.password') }}" title="Ganti Password" style="color: #94A3B8; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 6px; background: rgba(255,255,255,0.06);">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
      </a>
    </div>
  </aside>

  <!-- Main Content Area -->
  <div class="admin-main">
    <header class="admin-topbar">
      <div style="display: flex; align-items: center; gap: 12px; min-width: 0;">
        <button type="button" class="btn-sidebar-toggle" id="btnAdminSidebarToggle" onclick="toggleAdminSidebar()" aria-label="Buka Menu Sidebar">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
          </svg>
        </button>
        <div class="breadcrumb">
          <a href="{{ auth()->user()->isAdmin() ? route('backoffice.dashboard') : (auth()->user()->isEditor() ? route('backoffice.products.index') : route('backoffice.live-chats.index')) }}">Backoffice</a>
          <span>/</span>
          <span>@yield('breadcrumb', auth()->user()->isAdmin() ? 'Dashboard' : (auth()->user()->isEditor() ? 'Katalog Produk' : 'Live Chat'))</span>
        </div>
      </div>

      <div class="topbar-actions">
        @if(auth()->user()->canManageInbox())
          <!-- Desktop Notification Banner Button -->
          <button type="button" id="btnEnableDesktopNotif" onclick="toggleDesktopNotificationPermission()" class="btn-notif-toggle" title="Notifikasi Banner Laptop untuk Live Chat">
            <span id="notifBellIcon">🔔</span>
            <span id="notifBellLabel">Notif Laptop</span>
          </button>
        @endif

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

    @if(auth()->user()->canManageInbox())
      <!-- Global Sticky Alert Banner (Live Chat / Takeover / Inquiries) -->
      <div id="liveChatGlobalAlert" class="livechat-floating-banner" style="display: none;">
        <div class="banner-inner">
          <div class="banner-glow-icon" id="globalAlertGlowIcon">
            <span class="pulse-wave" id="globalAlertPulseWave"></span>
            <svg id="globalAlertSvgIcon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.3" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
          </div>
          <div class="banner-info">
            <div class="banner-headline">
              <span id="globalAlertBadge" class="badge-live-chat">CHAT MASUK</span>
              <span id="liveChatVisitorName" class="visitor-name"></span>
              <span id="liveChatVisitorTime" class="chat-time"></span>
            </div>
            <div id="liveChatMessageSnippet" class="message-snippet"></div>
          </div>
          <div class="banner-cta">
            <a id="liveChatDirectLink" href="#" class="btn-open-chat">
              <span id="globalAlertBtnText">Buka Chat</span>
              <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
            <button type="button" onclick="dismissLiveChatAlert()" class="btn-close-banner" aria-label="Tutup Banner">&times;</button>
          </div>
        </div>
      </div>
    @endif

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

  <script>
    function toggleAdminSidebar() {
      const sidebar = document.getElementById('adminSidebar');
      const backdrop = document.getElementById('adminSidebarBackdrop');
      if (!sidebar) return;
      const isOpen = sidebar.classList.contains('open');
      if (isOpen) {
        sidebar.classList.remove('open');
        if (backdrop) backdrop.classList.remove('active');
        document.body.style.overflow = '';
      } else {
        sidebar.classList.add('open');
        if (backdrop) backdrop.classList.add('active');
        document.body.style.overflow = 'hidden';
      }
    }

    function closeAdminSidebar() {
      const sidebar = document.getElementById('adminSidebar');
      const backdrop = document.getElementById('adminSidebarBackdrop');
      if (sidebar) sidebar.classList.remove('open');
      if (backdrop) backdrop.classList.remove('active');
      document.body.style.overflow = '';
    }

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeAdminSidebar();
    });
  </script>

  @if(auth()->user()->canManageInbox())
  <!-- Real-Time Notification Engine (Live Chat, AI Takeover Alerts, & Pesan Masuk Inquiries) -->
  <script>
  (function() {
    const notifToggleBtn = document.getElementById('btnEnableDesktopNotif');
    const notifBellIcon = document.getElementById('notifBellIcon');
    const notifBellLabel = document.getElementById('notifBellLabel');
    const globalAlert = document.getElementById('liveChatGlobalAlert');
    const globalAlertBadge = document.getElementById('globalAlertBadge');
    const globalAlertGlowIcon = document.getElementById('globalAlertGlowIcon');
    const globalAlertPulseWave = document.getElementById('globalAlertPulseWave');
    const globalAlertBtnText = document.getElementById('globalAlertBtnText');
    const visitorNameEl = document.getElementById('liveChatVisitorName');
    const visitorTimeEl = document.getElementById('liveChatVisitorTime');
    const messageSnippetEl = document.getElementById('liveChatMessageSnippet');
    const directLinkEl = document.getElementById('liveChatDirectLink');
    const sidebarLiveChatBadge = document.getElementById('sidebarLiveChatBadge');
    const sidebarInquiryBadge = document.getElementById('sidebarInquiryBadge');

    let lastSeenMessageId = 0;
    let lastSeenInquiryId = 0;
    let lastAlertedTakeoverId = 0;
    let audioCtx = null;
    let titleFlashInterval = null;
    const originalDocTitle = document.title;

    // Document Title Flashing on Inactive Tab
    function triggerTitleFlash(text) {
      if (!document.hidden) return; // Only flash if tab is in background
      if (titleFlashInterval) clearInterval(titleFlashInterval);
      let toggle = false;
      titleFlashInterval = setInterval(() => {
        document.title = toggle ? text : originalDocTitle;
        toggle = !toggle;
      }, 1100);
    }

    window.addEventListener('focus', () => {
      if (titleFlashInterval) {
        clearInterval(titleFlashInterval);
        titleFlashInterval = null;
        document.title = originalDocTitle;
      }
    });

    // Initialize Audio Context on user interaction to abide by browser autoplay policies
    function initAudio() {
      if (!audioCtx) {
        const AudioContextClass = window.AudioContext || window.webkitAudioContext;
        if (AudioContextClass) {
          audioCtx = new AudioContextClass();
        }
      }
      if (audioCtx && audioCtx.state === 'suspended') {
        audioCtx.resume();
      }
    }

    // Standard chime sound (pleasant & noticeable)
    function playNotificationChime() {
      try {
        initAudio();
        if (!audioCtx) return;

        const now = audioCtx.currentTime;

        // Tone 1: E5 (659.25 Hz) ramping to A5 (880 Hz)
        const osc1 = audioCtx.createOscillator();
        const gain1 = audioCtx.createGain();
        osc1.type = 'sine';
        osc1.frequency.setValueAtTime(659.25, now);
        osc1.frequency.exponentialRampToValueAtTime(880, now + 0.15);
        gain1.gain.setValueAtTime(0.001, now);
        gain1.gain.linearRampToValueAtTime(0.35, now + 0.03);
        gain1.gain.exponentialRampToValueAtTime(0.001, now + 0.4);
        osc1.connect(gain1);
        gain1.connect(audioCtx.destination);
        osc1.start(now);
        osc1.stop(now + 0.4);

        // Tone 2: D6 (1174.66 Hz) ramping to E6 (1318.51 Hz)
        const osc2 = audioCtx.createOscillator();
        const gain2 = audioCtx.createGain();
        osc2.type = 'triangle';
        osc2.frequency.setValueAtTime(880, now + 0.15);
        osc2.frequency.exponentialRampToValueAtTime(1318.51, now + 0.35);
        gain2.gain.setValueAtTime(0.001, now + 0.15);
        gain2.gain.linearRampToValueAtTime(0.45, now + 0.2);
        gain2.gain.exponentialRampToValueAtTime(0.0001, now + 0.75);
        osc2.connect(gain2);
        gain2.connect(audioCtx.destination);
        osc2.start(now + 0.15);
        osc2.stop(now + 0.75);
      } catch(e) {
        console.warn('Audio alert failed:', e);
      }
    }

    // Urgent chime sound for AI Human Takeover
    function playUrgentChime() {
      try {
        initAudio();
        if (!audioCtx) return;

        const now = audioCtx.currentTime;

        // Triple pulse alert (C6 - E6 - G6)
        [0, 0.16, 0.32].forEach((offset, idx) => {
          const freqs = [1046.50, 1318.51, 1567.98];
          const osc = audioCtx.createOscillator();
          const gain = audioCtx.createGain();
          osc.type = 'square';
          osc.frequency.setValueAtTime(freqs[idx], now + offset);
          gain.gain.setValueAtTime(0.001, now + offset);
          gain.gain.linearRampToValueAtTime(0.25, now + offset + 0.02);
          gain.gain.exponentialRampToValueAtTime(0.001, now + offset + 0.14);
          osc.connect(gain);
          gain.connect(audioCtx.destination);
          osc.start(now + offset);
          osc.stop(now + offset + 0.14);
        });
      } catch(e) {
        console.warn('Urgent chime failed:', e);
      }
    }

    // Update button UI based on Notification permission
    function updateNotifBtnUI() {
      if (!('Notification' in window)) {
        if (notifToggleBtn) notifToggleBtn.style.display = 'none';
        return;
      }
      if (Notification.permission === 'granted') {
        if (notifToggleBtn) {
          notifToggleBtn.classList.add('is-active');
          notifToggleBtn.title = 'Notifikasi Banner Laptop Aktif';
        }
        if (notifBellIcon) notifBellIcon.textContent = '🔔';
        if (notifBellLabel) notifBellLabel.textContent = 'Notif Aktif';
      } else if (Notification.permission === 'denied') {
        if (notifToggleBtn) {
          notifToggleBtn.classList.remove('is-active');
          notifToggleBtn.title = 'Notifikasi Laptop Diblokir oleh Pengaturan Browser';
        }
        if (notifBellIcon) notifBellIcon.textContent = '🔕';
        if (notifBellLabel) notifBellLabel.textContent = 'Notif Diblokir';
      } else {
        if (notifToggleBtn) {
          notifToggleBtn.classList.remove('is-active');
          notifToggleBtn.title = 'Klik untuk mengaktifkan notifikasi banner laptop';
        }
        if (notifBellIcon) notifBellIcon.textContent = '🔔';
        if (notifBellLabel) notifBellLabel.textContent = 'Aktifkan Notif';
      }
    }

    window.toggleDesktopNotificationPermission = async function() {
      initAudio();
      if (!('Notification' in window)) {
        alert('Browser Anda tidak mendukung Notifikasi Desktop.');
        return;
      }
      if (Notification.permission === 'granted') {
        playNotificationChime();
        triggerLaptopNotification('🔔 Notifikasi ATS Aktif', 'Notifikasi banner laptop telah aktif untuk Live Chat & Pesan Masuk!', null);
        return;
      }
      try {
        const permission = await Notification.requestPermission();
        updateNotifBtnUI();
        if (permission === 'granted') {
          playNotificationChime();
          triggerLaptopNotification('✅ Notifikasi Laptop Berhasil Diaktifkan!', 'Setiap chat atau pesan form masuk akan memunculkan banner di laptop Anda.', null);
        }
      } catch(err) {
        console.error(err);
      }
    };

    function triggerLaptopNotification(title, body, url) {
      if (!('Notification' in window) || Notification.permission !== 'granted') return;
      try {
        const notif = new Notification(title, {
          body: body,
          icon: '{{ asset("images/ats-logo.png") }}',
          badge: '{{ asset("images/ats-logo.png") }}',
          tag: 'ats-alert-' + Date.now(),
          renotify: true,
          requireInteraction: true // Keeps the banner on laptop screen until interacted!
        });
        notif.onclick = function(e) {
          e.preventDefault();
          window.focus();
          if (url) {
            window.location.href = url;
          }
          notif.close();
        };
      } catch(e) {
        console.warn('Native notification trigger failed:', e);
      }
    }

    window.dismissLiveChatAlert = function() {
      if (globalAlert) globalAlert.style.display = 'none';
    };

    function showInAppAlert(opts) {
      if (!globalAlert) return;
      
      // Update badge & styling
      if (globalAlertBadge) {
        globalAlertBadge.textContent = opts.badge || 'CHAT MASUK';
        if (opts.type === 'takeover') {
          globalAlertBadge.style.backgroundColor = '#D97706';
        } else if (opts.type === 'inquiry') {
          globalAlertBadge.style.backgroundColor = '#2563EB';
        } else {
          globalAlertBadge.style.backgroundColor = '#FC0001';
        }
      }

      if (globalAlertGlowIcon && globalAlertPulseWave) {
        const color = opts.type === 'takeover' ? '#D97706' : (opts.type === 'inquiry' ? '#2563EB' : '#FC0001');
        globalAlertGlowIcon.style.backgroundColor = color;
        globalAlertGlowIcon.style.boxShadow = `0 0 15px ${color}99`;
        globalAlertPulseWave.style.borderColor = color;
      }

      if (globalAlertBtnText) {
        globalAlertBtnText.textContent = opts.btnText || 'Buka Chat';
      }

      if (visitorNameEl) visitorNameEl.textContent = opts.title || 'Pengunjung';
      if (visitorTimeEl) visitorTimeEl.textContent = opts.time ? '• ' + opts.time : '';
      if (messageSnippetEl) messageSnippetEl.textContent = opts.snippet ? `"${opts.snippet}"` : '';
      if (directLinkEl) directLinkEl.href = opts.url || '#';

      globalAlert.style.display = 'block';
    }

    // Poll for new live chat messages, AI takeovers, and contact inquiries every 3.5s
    async function checkNotificationsEngine() {
      try {
        const url = `{{ route('backoffice.live-chats.notifications') }}?last_seen_id=${lastSeenMessageId}&last_seen_inquiry_id=${lastSeenInquiryId}`;
        const res = await fetch(url);
        if (!res.ok) return;
        const data = await res.json();

        // 1. Update live chat unread badge count
        if (sidebarLiveChatBadge) {
          if (data.unread_count > 0) {
            sidebarLiveChatBadge.textContent = data.unread_count;
            sidebarLiveChatBadge.style.display = 'inline-block';
          } else {
            sidebarLiveChatBadge.style.display = 'none';
          }
        }

        // 2. Update inquiries unread badge count
        if (sidebarInquiryBadge) {
          if (data.unread_inquiries_count > 0) {
            sidebarInquiryBadge.textContent = data.unread_inquiries_count;
            sidebarInquiryBadge.style.display = 'inline-block';
          } else {
            sidebarInquiryBadge.style.display = 'none';
          }
        }

        // Initial pass: seed IDs so existing past records don't falsely ring alarms on page load
        if (lastSeenMessageId === 0 && lastSeenInquiryId === 0) {
          lastSeenMessageId = data.latest_id || 1;
          lastSeenInquiryId = data.latest_inquiry_id || 1;
          return;
        }

        // 3. Urgent AI Human Takeover Alert
        if (data.needs_urgent_takeover && data.takeover_sessions && data.takeover_sessions.length > 0) {
          const firstTakeover = data.takeover_sessions[0];
          if (firstTakeover.id !== lastAlertedTakeoverId) {
            lastAlertedTakeoverId = firstTakeover.id;

            playUrgentChime();
            triggerTitleFlash('⚠️ [BUTUH ADMIN] AI Perlu Bantuan!');

            triggerLaptopNotification(
              `⚠️ BUTUH BANTUAN ADMIN: ${firstTakeover.visitor_name}`,
              `AI mengalihkan sesi chat ini karena butuh konfirmasi harga/teknis dari engineer.`,
              `/backoffice/live-chats/${firstTakeover.id}`
            );

            showInAppAlert({
              type: 'takeover',
              badge: '⚠️ BUTUH ADMIN SEGERA',
              title: `${firstTakeover.visitor_name} (${firstTakeover.visitor_contact || 'Online'})`,
              time: 'Sekarang',
              snippet: 'AI menyarankan pengunjung ke WhatsApp & memerlukan balasan langsung dari engineer ATS.',
              btnText: 'Ambil Alih Chat',
              url: `/backoffice/live-chats/${firstTakeover.id}`
            });
          }
        }

        // 4. New Live Chat Visitor Message
        if (data.has_new && data.latest_message) {
          lastSeenMessageId = data.latest_id;

          playNotificationChime();
          triggerTitleFlash(`(1) 💬 Chat: ${data.latest_message.visitor_name}`);

          triggerLaptopNotification(
            `💬 Live Chat: ${data.latest_message.visitor_name}`,
            data.latest_message.message,
            `/backoffice/live-chats/${data.latest_message.session_id}`
          );

          showInAppAlert({
            type: 'chat',
            badge: 'CHAT MASUK',
            title: `${data.latest_message.visitor_name} ${data.latest_message.visitor_contact ? '(' + data.latest_message.visitor_contact + ')' : ''}`,
            time: data.latest_message.time,
            snippet: data.latest_message.message,
            btnText: 'Buka Chat',
            url: `/backoffice/live-chats/${data.latest_message.session_id}`
          });
        } else if (data.latest_id > lastSeenMessageId) {
          lastSeenMessageId = data.latest_id;
        }

        // 5. New Contact Form Inquiry (Pesan Masuk)
        if (data.has_new_inquiry && data.latest_inquiry) {
          lastSeenInquiryId = data.latest_inquiry_id;

          playNotificationChime();
          triggerTitleFlash(`(1) 📩 Pesan: ${data.latest_inquiry.name}`);

          triggerLaptopNotification(
            `📩 Pesan Form Kontak: ${data.latest_inquiry.name}`,
            `${data.latest_inquiry.subject} - ${data.latest_inquiry.message}`,
            `/backoffice/inquiries/${data.latest_inquiry.id}`
          );

          showInAppAlert({
            type: 'inquiry',
            badge: 'PESAN FORM MASUK',
            title: `${data.latest_inquiry.name} (${data.latest_inquiry.email || data.latest_inquiry.phone || 'Form'})`,
            time: data.latest_inquiry.time,
            snippet: `${data.latest_inquiry.subject}: ${data.latest_inquiry.message}`,
            btnText: 'Buka Pesan',
            url: `/backoffice/inquiries/${data.latest_inquiry.id}`
          });
        } else if (data.latest_inquiry_id > lastSeenInquiryId) {
          lastSeenInquiryId = data.latest_inquiry_id;
        }
      } catch(err) {
        // silent network retry
      }
    }

    // Init UI & start polling
    document.addEventListener('DOMContentLoaded', () => {
      updateNotifBtnUI();
      checkNotificationsEngine();
      setInterval(checkNotificationsEngine, 3500);

      // Warm up audio context on first user click anywhere in the page
      document.addEventListener('click', () => {
        initAudio();
      }, { once: true });
    });
  })();
  </script>
  @endif

  @include('backoffice.partials.wysiwyg')

  @stack('scripts')
</body>
</html>
