<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Prototipe POS</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#FFFDF7] min-h-screen flex">
  <!-- Sisi Kiri -->
  <div class="hidden lg:flex w-1/2 bg-[#5B4636] text-white flex-col justify-between p-16">
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 rounded-lg bg-[#8C6D53] flex items-center justify-center font-bold text-lg">K</div>
      <span class="font-bold text-xl">Kasir</span>
    </div>
    <div class="max-w-md">
      <span class="text-xs uppercase tracking-widest text-[#D4C3B3] font-semibold">SISTEM MANAJEMEN TOKO</span>
      <h1 class="text-4xl font-extrabold mt-3 mb-4 leading-tight">Kelola toko Anda dengan mudah</h1>
      <p class="text-[#D4C3B3] text-sm leading-relaxed">Pantau penjualan, stok, dan arus kas dalam satu ruang kerja yang rapi dan efisien.</p>
    </div>
    <div class="border-t border-[#7A604D] pt-6 flex gap-6 text-xs text-[#D4C3B3]">
      <span>Penjualan terpantau</span>
      <span>•</span>
      <span>Stok terkendali</span>
      <span>•</span>
      <span>Laporan akurat</span>
    </div>
  </div>

  <!-- Sisi Kanan Form -->
  <div class="flex-1 flex items-center justify-center p-8">
    <div class="bg-white p-10 rounded-2xl border border-stone-200 shadow-sm max-w-md w-full">
      <span class="text-xs font-bold uppercase text-stone-500 tracking-wider">Selamat Datang Kembali</span>
      <h2 class="text-2xl font-bold text-stone-900 mt-1 mb-2">Masuk ke akun Anda</h2>
      <p class="text-xs text-stone-500 mb-6">Gunakan kredensial Anda untuk melanjutkan.</p>

      <form action="dashboard.html" class="space-y-4">
        <div>
          <label class="block text-xs font-semibold text-stone-700 mb-1">Username atau Email</label>
          <input type="text" placeholder="Masukkan username atau email" class="w-full text-sm border border-stone-300 rounded-lg px-3.5 py-2.5 focus:outline-none focus:ring-1 focus:ring-[#8C6D53]">
        </div>
        <div>
          <label class="block text-xs font-semibold text-stone-700 mb-1">Kata Sandi</label>
          <div class="relative">
            <input type="password" placeholder="Masukkan kata sandi" class="w-full text-sm border border-stone-300 rounded-lg px-3.5 py-2.5 focus:outline-none focus:ring-1 focus:ring-[#8C6D53]">
            <i class="fa-regular fa-eye absolute right-3.5 top-3.5 text-stone-400 cursor-pointer text-xs"></i>
          </div>
        </div>
        <div class="flex items-center justify-between text-xs">
          <label class="flex items-center gap-2 text-stone-600">
            <input type="checkbox" class="rounded text-[#8C6D53]"> Ingat saya
          </label>
          <a href="#" class="font-semibold text-stone-700 hover:underline">Lupa kata sandi?</a>
        </div>
        <button type="submit" class="w-full bg-[#8C6D53] hover:bg-[#785c45] text-white py-2.5 rounded-lg text-sm font-semibold transition">Masuk</button>
      </form>
      <div class="bg-[#FAF7F2] border border-stone-200 text-stone-600 text-xs text-center py-2.5 rounded-lg mt-5">
        Akun demo: <strong>admin</strong> / <strong>admin123</strong>
      </div>
    </div>
  </div>
</body>
</html>