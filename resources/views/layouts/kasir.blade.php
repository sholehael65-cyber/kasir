<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard Kasir - POS & Manajemen Toko')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#FAF7F2] min-h-screen flex font-sans">
  <!-- Sidebar Kasir -->
  <aside class="w-64 bg-[#5B4636] text-[#D4C3B3] flex flex-col justify-between py-6 px-4">
    <div class="space-y-6">
      <div class="flex items-center gap-3 px-2">
        <div class="w-10 h-10 rounded-lg bg-[#8C6D53] text-white flex items-center justify-center font-bold">K</div>
        <div>
          <div class="text-white font-semibold text-sm">Kasir</div>
          <div class="text-[10px] text-stone-300 tracking-wider uppercase">POINT OF SALE</div>
        </div>
      </div>

      <nav class="space-y-1 text-xs">
        <a href="{{ route('kasir.dashboard') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('kasir.dashboard') ? 'bg-[#7A604D] text-white font-medium' : 'hover:bg-[#6e5543] hover:text-white' }}">
          <i class="fa-solid fa-border-all w-4"></i> Dashboard Kasir
        </a>
        <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-[#6e5543] hover:text-white">
          <i class="fa-solid fa-cash-register w-4"></i> Transaksi Baru (POS)
        </a>
        <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-[#6e5543] hover:text-white">
          <i class="fa-solid fa-clock-rotate-left w-4"></i> Riwayat Transaksi
        </a>
        <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-[#6e5543] hover:text-white">
          <i class="fa-solid fa-boxes-stacked w-4"></i> Cek Stok Barang
        </a>
        <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-[#6e5543] hover:text-white">
          <i class="fa-solid fa-key w-4"></i> Ubah Password
        </a>
      </nav>
    </div>

    <div class="space-y-4">
      <!-- Tombol Logout -->
      <form action="{{ route('logout') }}" method="POST" class="px-2">
        @csrf
        <button type="submit" class="w-full flex items-center gap-2 text-xs text-rose-300 hover:text-white py-2 px-3 rounded-lg hover:bg-[#6e5543] transition">
          <i class="fa-solid fa-right-from-bracket w-4"></i> Keluar
        </button>
      </form>

      <div class="text-[11px] px-2 flex items-center gap-2">
        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
        <div>
          <span class="text-white font-medium">Shift Aktif</span><br>
          <span class="text-[10px]">Versi 1.0.0</span>
        </div>
      </div>
    </div>
  </aside>

  <!-- Konten Utama Kasir -->
  <main class="flex-1 flex flex-col">
    <header class="h-16 bg-white border-b border-stone-200 px-8 flex items-center justify-between">
      <div>
        <h2 class="text-xs font-bold text-stone-800">@yield('header-title', 'Dashboard Kasir')</h2>
        <p class="text-[10px] text-stone-400">Kasir • Bandung</p>
      </div>
      <div class="flex items-center gap-3">
        @php
          $userName = Auth::user()->name ?? 'Siti Aminah';
          $initials = collect(explode(' ', $userName))->map(fn($w) => strtoupper(substr($w, 0, 1)))->take(2)->join('');
        @endphp
        <div class="w-8 h-8 rounded-full bg-[#8C6D53] text-white flex items-center justify-center text-xs font-bold">
          {{ $initials }}
        </div>
        <div class="text-xs text-right">
          <p class="font-semibold text-stone-800 leading-tight">{{ $userName }}</p>
          <span class="text-[10px] text-stone-400">Petugas Kasir</span>
        </div>
      </div>
    </header>

    <div class="p-8 space-y-6 overflow-y-auto">
      @yield('content')
    </div>
  </main>
</body>
</html>