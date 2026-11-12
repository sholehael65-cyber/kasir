<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Owner - POS & Manajemen Toko</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#FAF7F2] min-h-screen flex font-sans">
  <!-- Sidebar Lengkap Owner -->
  <aside class="w-64 bg-[#5B4636] text-[#D4C3B3] flex flex-col justify-between py-6 px-4">
    <div class="space-y-6">
      <div class="flex items-center gap-3 px-2">
        <div class="w-10 h-10 rounded-lg bg-[#8C6D53] text-white flex items-center justify-center font-bold">K</div>
        <div>
          <div class="text-white font-semibold text-sm">Kasir</div>
          <div class="text-[10px] text-stone-300 tracking-wider uppercase">MANAJEMEN TOKO</div>
        </div>
      </div>
      <nav class="space-y-1 text-xs">
        <a href="dashboard-owner.html" class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-[#7A604D] text-white font-medium">
          <i class="fa-solid fa-border-all w-4"></i> Dashboard Utama
        </a>
        <a href="data-kategori.html" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-[#6e5543] hover:text-white">
          <i class="fa-regular fa-folder w-4"></i> Data Kategori
        </a>
        <a href="data-barang.html" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-[#6e5543] hover:text-white">
          <i class="fa-solid fa-box-archive w-4"></i> Data Barang
        </a>
        <a href="transaksi-pos.html" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-[#6e5543] hover:text-white">
          <i class="fa-regular fa-newspaper w-4"></i> Transaksi Kasir (POS)
        </a>
        <a href="barang-masuk.html" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-[#6e5543] hover:text-white">
          <i class="fa-solid fa-truck w-4"></i> Barang Masuk & Pemasok
        </a>
        <a href="laporan-keuangan.html" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-[#6e5543] hover:text-white">
          <i class="fa-solid fa-chart-column w-4"></i> Laporan Keuangan
        </a>
        <a href="arus-kas.html" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-[#6e5543] hover:text-white">
          <i class="fa-solid fa-right-left w-4"></i> Arus Kas (Keluar/Masuk)
        </a>
        <a href="kelola-kasir.html" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-[#6e5543] hover:text-white">
          <i class="fa-solid fa-users w-4"></i> Pengelolaan Data Kasir
        </a>
        <a href="pengaturan.html" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-[#6e5543] hover:text-white">
          <i class="fa-solid fa-gear w-4"></i> Pengaturan & Reset Password
        </a>
      </nav>
    </div>
    <div class="text-[11px] px-2 flex items-center gap-2">
      <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
      <div>
        <span class="text-white font-medium">Sistem normal</span><br>
        <span class="text-[10px]">Versi 1.0.0</span>
      </div>
    </div>
  </aside>

  <!-- Konten Utama Owner -->
  <main class="flex-1 flex flex-col">
    <header class="h-16 bg-white border-b border-stone-200 px-8 flex items-center justify-between">
      <div>
        <h2 class="text-xs font-bold text-stone-800">Dashboard Utama</h2>
        <p class="text-[10px] text-stone-400">Kasir • Bandung</p>
      </div>
      <div class="flex items-center gap-3">
        <div class="w-8 h-8 rounded-full bg-[#8C6D53] text-white flex items-center justify-center text-xs font-bold">NE</div>
        <div class="text-xs text-right">
          <p class="font-semibold text-stone-800 leading-tight">Nabila El-Sholeha</p>
          <span class="text-[10px] text-stone-400">Owner (Admin)</span>
        </div>
      </div>
    </header>

    @yield('content')
  </main>
</body>
</html>