@extends('layouts.owner')

@section('title', 'Dashboard Utama - Owner')
@section('header-title', 'Dashboard Utama')

@section('content')
  <div>
    <span class="text-xs text-stone-500">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
    <h1 class="text-2xl font-bold text-stone-800">Selamat datang, {{ Auth::user()->name ?? 'Nabila El-Sholeha' }}</h1>
    <p class="text-xs text-stone-500 mt-1">Berikut ringkasan performa toko Anda hari ini.</p>
  </div>

  <!-- Ringkasan Finansial Toko -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
    <div class="bg-white p-4 rounded-xl border border-stone-200">
      <div class="flex justify-between items-start mb-2">
        <span class="w-8 h-8 rounded bg-[#F8F3EE] text-[#8C6D53] flex items-center justify-center text-xs"><i class="fa-solid fa-chart-simple"></i></span>
        <span class="text-xs text-emerald-600 font-bold">+12,5%</span>
      </div>
      <p class="text-[11px] text-stone-400">Total Penjualan</p>
      <h3 class="text-lg font-bold text-stone-800">Rp {{ number_format($totalPenjualan ?? 18750000, 0, ',', '.') }}</h3>
      <span class="text-[10px] text-stone-400">dibanding bulan lalu</span>
    </div>

    <div class="bg-white p-4 rounded-xl border border-stone-200">
      <div class="flex justify-between items-start mb-2">
        <span class="w-8 h-8 rounded bg-[#F8F3EE] text-[#8C6D53] flex items-center justify-center text-xs"><i class="fa-regular fa-calendar-check"></i></span>
        <span class="text-xs text-emerald-600 font-bold">+8,2%</span>
      </div>
      <p class="text-[11px] text-stone-400">Total Transaksi</p>
      <h3 class="text-lg font-bold text-stone-800">{{ $totalTransaksi ?? 428 }}</h3>
      <span class="text-[10px] text-stone-400">dibanding bulan lalu</span>
    </div>

    <div class="bg-white p-4 rounded-xl border border-stone-200">
      <div class="flex justify-between items-start mb-2">
        <span class="w-8 h-8 rounded bg-[#F8F3EE] text-[#8C6D53] flex items-center justify-center text-xs"><i class="fa-solid fa-coins"></i></span>
        <span class="text-xs text-emerald-600 font-bold">+10,1%</span>
      </div>
      <p class="text-[11px] text-stone-400">Laba Bersih</p>
      <h3 class="text-lg font-bold text-stone-800">Rp {{ number_format($labaBersih ?? 6425000, 0, ',', '.') }}</h3>
      <span class="text-[10px] text-stone-400">dibanding bulan lalu</span>
    </div>

    <div class="bg-white p-4 rounded-xl border border-stone-200">
      <div class="flex justify-between items-start mb-2">
        <span class="w-8 h-8 rounded bg-[#F8F3EE] text-[#8C6D53] flex items-center justify-center text-xs"><i class="fa-solid fa-truck"></i></span>
        <span class="text-xs text-rose-500 font-bold">-3,4%</span>
      </div>
      <p class="text-[11px] text-stone-400">Kas Keluar</p>
      <h3 class="text-lg font-bold text-stone-800">Rp {{ number_format($kasKeluar ?? 4850000, 0, ',', '.') }}</h3>
      <span class="text-[10px] text-stone-400">dibanding bulan lalu</span>
    </div>
  </div>

  <!-- Tren Penjualan & Produk Terlaris -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-white p-6 rounded-xl border border-stone-200">
      <div class="flex justify-between items-center mb-6">
        <div>
          <h3 class="font-bold text-sm text-stone-800">Tren Penjualan</h3>
          <p class="text-[11px] text-stone-400">Performa penjualan mingguan</p>
        </div>
        <div class="bg-stone-100 rounded-lg p-1 flex text-[10px]">
          <button type="button" class="bg-white px-2.5 py-1 rounded shadow-sm font-semibold text-stone-800">Mingguan</button>
          <button type="button" class="px-2.5 py-1 text-stone-500">Bulanan</button>
        </div>
      </div>
      <div class="h-48 flex items-end justify-between gap-4 px-4 pb-2 border-b border-stone-100">
        <div class="w-full bg-[#C2A58D] rounded-t h-24"></div>
        <div class="w-full bg-[#C2A58D] rounded-t h-32"></div>
        <div class="w-full bg-[#C2A58D] rounded-t h-28"></div>
        <div class="w-full bg-[#C2A58D] rounded-t h-40"></div>
        <div class="w-full bg-[#C2A58D] rounded-t h-36"></div>
        <div class="w-full bg-[#C2A58D] rounded-t h-48"></div>
        <div class="w-full bg-[#C2A58D] rounded-t h-40"></div>
      </div>
      <div class="flex justify-between text-[10px] text-stone-400 pt-2 px-4">
        <span>Sen</span><span>Sel</span><span>Rab</span><span>Kam</span><span>Jum</span><span>Sab</span><span>Min</span>
      </div>
    </div>

    <div class="bg-white p-6 rounded-xl border border-stone-200">
      <div class="flex justify-between items-center mb-4">
        <div>
          <h3 class="font-bold text-sm text-stone-800">Produk Terlaris</h3>
          <p class="text-[10px] text-stone-400">Berdasarkan jumlah terjual</p>
        </div>
        <span class="text-[10px] bg-stone-100 text-stone-500 px-2 py-0.5 rounded">{{ \Carbon\Carbon::now()->translatedFormat('M Y') }}</span>
      </div>

      @php
        // Data dummy sementara jika belum ditarik dari database
        $produkTerlaris = $produkTerlaris ?? [
          ['nama' => 'Minyak Sunco 2L', 'kategori' => 'Makanan', 'terjual' => 84],
          ['nama' => 'Air Le Minerale 600ml', 'kategori' => 'Minuman', 'terjual' => 73],
          ['nama' => 'Beras Pandan Wangi 5kg', 'kategori' => 'Makanan', 'terjual' => 62],
          ['nama' => 'Kopi Kapal Api 165gr', 'kategori' => 'Minuman', 'terjual' => 51],
          ['nama' => 'Sari Roti Tawar Kupas', 'kategori' => 'Makanan', 'terjual' => 40],
        ];
      @endphp

      <div class="space-y-3">
        @foreach($produkTerlaris as $index => $item)
          <div class="flex items-center justify-between text-xs">
            <div class="flex items-center gap-2.5">
              <span class="text-[11px] text-stone-400 w-3">{{ $index + 1 }}</span>
              <div class="w-7 h-7 rounded bg-[#F8F3EE] text-[#8C6D53] flex items-center justify-center text-[11px]">
                <i class="fa-solid fa-box"></i>
              </div>
              <div>
                <p class="text-stone-700 font-medium leading-tight">{{ $item['nama'] }}</p>
                <span class="text-[10px] text-stone-400">{{ $item['kategori'] }}</span>
              </div>
            </div>
            <span class="text-stone-600 font-bold">{{ $item['terjual'] }} <span class="font-normal text-stone-400">terjual</span></span>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection