@extends('layouts.app')

@section('content')

<div class="p-8 space-y-6 overflow-y-auto">
      <div class="flex justify-between items-center">
        <div>
          <span class="text-xs text-stone-500">Senin, 12 Mei 2025</span>
          <h1 class="text-2xl font-bold text-stone-800">Halo, Aulia Rahman</h1>
          <p class="text-xs text-stone-500 mt-1">Siap melayani transaksi pelanggan hari ini.</p>
        </div>
        <a href="transaksi-pos.html" class="bg-[#8C6D53] hover:bg-[#785c45] text-white px-5 py-2.5 rounded-lg text-xs font-semibold flex items-center gap-2 shadow-sm transition">
          <i class="fa-solid fa-cash-register"></i> Buka Mesin Kasir (POS)
        </a>
      </div>

      <!-- Ringkasan Shift Kasir Hari Ini -->
      <div class="grid grid-cols-3 gap-6">
        <div class="bg-white p-5 rounded-xl border border-stone-200">
          <div class="flex justify-between items-start mb-2">
            <span class="w-8 h-8 rounded bg-[#F8F3EE] text-[#8C6D53] flex items-center justify-center text-xs"><i class="fa-solid fa-wallet"></i></span>
            <span class="text-xs text-emerald-600 font-bold">Shift Pagi</span>
          </div>
          <p class="text-[11px] text-stone-400">Total Penjualan Shift Ini</p>
          <h3 class="text-xl font-bold text-stone-800">Rp 2.450.000</h3>
        </div>
        <div class="bg-white p-5 rounded-xl border border-stone-200">
          <div class="flex justify-between items-start mb-2">
            <span class="w-8 h-8 rounded bg-[#F8F3EE] text-[#8C6D53] flex items-center justify-center text-xs"><i class="fa-solid fa-receipt"></i></span>
            <span class="text-xs text-stone-400 font-bold">Hari ini</span>
          </div>
          <p class="text-[11px] text-stone-400">Transaksi Selesai</p>
          <h3 class="text-xl font-bold text-stone-800">34 Struk</h3>
        </div>
        <div class="bg-white p-5 rounded-xl border border-stone-200">
          <div class="flex justify-between items-start mb-2">
            <span class="w-8 h-8 rounded bg-[#F8F3EE] text-[#8C6D53] flex items-center justify-center text-xs"><i class="fa-solid fa-money-bill-wave"></i></span>
            <span class="text-xs text-emerald-600 font-bold">Aktif</span>
          </div>
          <p class="text-[11px] text-stone-400">Modal Kas Masuk</p>
          <h3 class="text-xl font-bold text-stone-800">Rp 500.000</h3>
        </div>
      </div>

      <!-- Transaksi Terakhir di Kasir Ini -->
      <div class="bg-white rounded-xl border border-stone-200 p-6 space-y-4">
        <div class="flex justify-between items-center">
          <h3 class="font-bold text-sm text-stone-800">Transaksi Terakhir Kasir</h3>
          <span class="text-xs text-stone-400">Sinkronisasi otomatis</span>
        </div>
        <table class="w-full text-left text-xs text-stone-600">
          <thead class="bg-[#FAF7F2] text-[10px] font-bold uppercase text-stone-500 border-b border-stone-200">
            <tr>
              <th class="p-3">Waktu</th>
              <th class="p-3">No. Nota</th>
              <th class="p-3">Metode Bayar</th>
              <th class="p-3">Total Belanja</th>
              <th class="p-3 text-center">Status</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-stone-100">
            <tr>
              <td class="p-3">10:42 WIB</td>
              <td class="p-3 font-semibold text-stone-800">#TRX-00432</td>
              <td class="p-3">Tunai</td>
              <td class="p-3 font-bold text-stone-800">Rp 75.000</td>
              <td class="p-3 text-center"><span class="bg-emerald-50 text-emerald-700 px-2 py-0.5 rounded text-[10px]">Berhasil</span></td>
            </tr>
            <tr>
              <td class="p-3">10:28 WIB</td>
              <td class="p-3 font-semibold text-stone-800">#TRX-00431</td>
              <td class="p-3">QRIS</td>
              <td class="p-3 font-bold text-stone-800">Rp 35.000</td>
              <td class="p-3 text-center"><span class="bg-emerald-50 text-emerald-700 px-2 py-0.5 rounded text-[10px]">Berhasil</span></td>
            </tr>
            <tr>
              <td class="p-3">10:15 WIB</td>
              <td class="p-3 font-semibold text-stone-800">#TRX-00430</td>
              <td class="p-3">Tunai</td>
              <td class="p-3 font-bold text-stone-800">Rp 120.000</td>
              <td class="p-3 text-center"><span class="bg-emerald-50 text-emerald-700 px-2 py-0.5 rounded text-[10px]">Berhasil</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
@endsection
