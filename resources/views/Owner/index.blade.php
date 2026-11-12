@extends('layouts.app')

@section('content')
 <div class="p-8 space-y-6 overflow-y-auto">
      <div>
        <span class="text-xs text-stone-500">Senin, 12 Mei 2025</span>
        <h1 class="text-2xl font-bold text-stone-800">Selamat datang, Nabila El-Sholeha</h1>
        <p class="text-xs text-stone-500 mt-1">Berikut ringkasan performa toko Anda hari ini.</p>
      </div>

      <!-- Ringkasan Finansial Toko -->
      <div class="grid grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded-xl border border-stone-200">
          <div class="flex justify-between items-start mb-2">
            <span class="w-8 h-8 rounded bg-[#F8F3EE] text-[#8C6D53] flex items-center justify-center text-xs"><i class="fa-solid fa-chart-simple"></i></span>
            <span class="text-xs text-emerald-600 font-bold">+12,5%</span>
          </div>
          <p class="text-[11px] text-stone-400">Total Penjualan</p>
          <h3 class="text-lg font-bold text-stone-800">Rp 18.750.000</h3>
          <span class="text-[10px] text-stone-400">dibanding bulan lalu</span>
        </div>
        <div class="bg-white p-4 rounded-xl border border-stone-200">
          <div class="flex justify-between items-start mb-2">
            <span class="w-8 h-8 rounded bg-[#F8F3EE] text-[#8C6D53] flex items-center justify-center text-xs"><i class="fa-regular fa-calendar-check"></i></span>
            <span class="text-xs text-emerald-600 font-bold">+8,2%</span>
          </div>
          <p class="text-[11px] text-stone-400">Total Transaksi</p>
          <h3 class="text-lg font-bold text-stone-800">428</h3>
          <span class="text-[10px] text-stone-400">dibanding bulan lalu</span>
        </div>
        <div class="bg-white p-4 rounded-xl border border-stone-200">
          <div class="flex justify-between items-start mb-2">
            <span class="w-8 h-8 rounded bg-[#F8F3EE] text-[#8C6D53] flex items-center justify-center text-xs"><i class="fa-solid fa-coins"></i></span>
            <span class="text-xs text-emerald-600 font-bold">+10,1%</span>
          </div>
          <p class="text-[11px] text-stone-400">Laba Bersih</p>
          <h3 class="text-lg font-bold text-stone-800">Rp 6.425.000</h3>
          <span class="text-[10px] text-stone-400">dibanding bulan lalu</span>
        </div>
        <div class="bg-white p-4 rounded-xl border border-stone-200">
          <div class="flex justify-between items-start mb-2">
            <span class="w-8 h-8 rounded bg-[#F8F3EE] text-[#8C6D53] flex items-center justify-center text-xs"><i class="fa-solid fa-truck"></i></span>
            <span class="text-xs text-rose-500 font-bold">-3,4%</span>
          </div>
          <p class="text-[11px] text-stone-400">Kas Keluar</p>
          <h3 class="text-lg font-bold text-stone-800">Rp 4.850.000</h3>
          <span class="text-[10px] text-stone-400">dibanding bulan lalu</span>
        </div>
      </div>

      <!-- Tren Penjualan & Produk Terlaris -->
      <div class="grid grid-cols-3 gap-6">
        <div class="col-span-2 bg-white p-6 rounded-xl border border-stone-200">
          <div class="flex justify-between items-center mb-6">
            <div>
              <h3 class="font-bold text-sm text-stone-800">Tren Penjualan</h3>
              <p class="text-[11px] text-stone-400">Performa penjualan mingguan</p>
            </div>
            <div class="bg-stone-100 rounded-lg p-1 flex text-[10px]">
              <button class="bg-white px-2.5 py-1 rounded shadow-sm font-semibold text-stone-800">Mingguan</button>
              <button class="px-2.5 py-1 text-stone-500">Bulanan</button>
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
            <h3 class="font-bold text-sm text-stone-800">Produk Terlaris</h3>
            <span class="text-[10px] bg-stone-100 text-stone-500 px-2 py-0.5 rounded">Mei 2025</span>
          </div>
          <div class="space-y-3">
            <div class="flex items-center justify-between text-xs">
              <span class="text-stone-700 font-medium">1. Minyak Sunco 2L</span>
              <span class="text-stone-500 font-bold">84 terjual</span>
            </div>
            <div class="flex items-center justify-between text-xs">
              <span class="text-stone-700 font-medium">2. Air Le Minerale 600ml</span>
              <span class="text-stone-500 font-bold">73 terjual</span>
            </div>
            <div class="flex items-center justify-between text-xs">
              <span class="text-stone-700 font-medium">3. Beras Pandan Wangi 5kg</span>
              <span class="text-stone-500 font-bold">62 terjual</span>
            </div>
            <div class="flex items-center justify-between text-xs">
              <span class="text-stone-700 font-medium">4. Kopi Kapal Api 165gr</span>
              <span class="text-stone-500 font-bold">51 terjual</span>
            </div>
            <div class="flex items-center justify-between text-xs">
              <span class="text-stone-700 font-medium">5. Sari Roti Tawar Kupas</span>
              <span class="text-stone-500 font-bold">40 terjual</span>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection