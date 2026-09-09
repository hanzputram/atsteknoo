<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Portfolio &amp; Valued Clients - PT. Anugerah Tama Sejati</title>
  <meta name="description" content="Leading industrial clients and valued enterprises who trust PT. Anugerah Tama Sejati for premium electrical components and industrial automation solutions.">

  <!-- Google Fonts: Outfit & Plus Jakarta Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Tailwind CSS via CDN (untuk preview standalone) -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['"Plus Jakarta Sans"', 'sans-serif'],
            outfit: ['"Outfit"', 'sans-serif'],
          },
          colors: {
            brand: {
              50: '#FFF1F2',
              100: '#FFE4E6',
              500: '#F43F5E',
              600: '#E11D48',
              700: '#BE123C',
              dark: '#0F172A',
            }
          }
        }
      }
    }
  </script>

  <!-- Swiper CSS CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <style>
    body {
      font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
      background-color: #F8FAFC;
      background-image:
        radial-gradient(circle at 50% 0%, rgba(225, 29, 72, 0.08) 0%, rgba(248, 250, 252, 0.9) 60%, #F8FAFC 100%),
        radial-gradient(circle at 85% 30%, rgba(254, 205, 211, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 15% 40%, rgba(255, 180, 180, 0.1) 0%, transparent 45%);
      min-height: 100vh;
      color: #0F172A;
    }
  </style>
</head>
<body class="antialiased selection:bg-rose-500 selection:text-white">

  <!-- Header / Navigation Bar Preview -->
  <header class="border-b border-slate-200/80 bg-white/80 backdrop-blur-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-rose-600 to-rose-400 flex items-center justify-center text-white font-extrabold text-lg shadow-md shadow-rose-500/30">
          ATS
        </div>
        <div>
          <h1 class="text-base font-extrabold tracking-tight text-slate-900 leading-tight">PT. ANUGERAH TAMA SEJATI</h1>
          <p class="text-[11px] font-semibold text-rose-600 tracking-wider uppercase">Electrical Supplier Surabaya</p>
        </div>
      </div>

      <a href="/" class="text-xs font-semibold px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 transition">
        &larr; Back to Home
      </a>
    </div>
  </header>

  <!-- Main Container -->
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-16">
    
    <!-- Panggil Komponen Blade Lifted Carousel -->
    @include('components.customer-carousel', ['customers' => $customers])

    <!-- Panggil Komponen Our Product sesuai wireframe Figma -->
    @include('components.our-products')

  </main>

  <!-- Industrial Skyline Footer with 3 Interactive Google Maps Embeds -->
  @include('components.footer')

</body>
</html>
