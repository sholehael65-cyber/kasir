@extends('layouts.kasir')

@section('title', 'Dashboard Kasir')
@section('header-title', 'Dashboard Kasir')

@section('content')
  <!-- Header Sambutan & Tombol Cepat POS -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <span class="text-xs text-stone-500">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
      <h1 class="text-2xl font-bold text-stone-800">Halo, {{ Auth::user()->name ?? 'Siti Aminah' }}</h1>
      <p class="text-xs text-stone-500 mt-1">Siap melayani transaksi pelanggan hari ini.</p>
    </div>

    <a href="#" class="inline-flex items-center gap-2 bg-[#5B4636] hover:bg-[#49372a] text-white text-xs font-semibold px-5 py-3 rounded-xl shadow-sm transition">
      <i class="fa-solid fa-plus"></i> Mulai Transaksi Baru (POS)
    </a>
  </div>

  <!-- Ringkasan Kinerja Hari Ini -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="bg-white p-5 rounded-xl border border-stone-200">
      <div class="flex justify-between items-start mb-3">
        <span class="w-9 h-9 rounded-lg bg-[#F8F3EE] text-[#8C6D53] flex items-center justify-center text-sm">
          <i class="fa-solid fa-wallet"></i>
        </span>
        <span class="text-[10px] bg-emerald-50 text-emerald-600 px-2 py-0.5 rounded font-semibold">Hari Ini</span>
      </div>
      <p class="text-[11px] text-stone-400">Total Pemasukan Shift</p>
      <h3 class="text-xl font-bold text-stone-800 mt-0.5">Rp {{ number_format($pemasukanHariIni ?? 1450000, 0, ',', '.') }}</h3>
    </div>

    <div class="bg-white p-5 rounded-xl border border-stone-200">
      <div class="flex justify-between items-start mb-3">
        <span class="w-9 h-9 rounded-lg bg-[#F8F3EE] text-[#8C6D53] flex items-center justify-center text-sm">
          <i class="fa-solid fa-receipt"></i>
        </span>
        <span class="text-[10px] bg-stone-100 text-stone-600 px-2 py-0.5 rounded font-semibold">Struk</span>
      </div>
      <p class="text-[11px] text-stone-400">Transaksi Berhasil</p>
      <h3 class="text-xl font-bold text-stone-800 mt-0.5">{{ $jumlahTransaksi ?? 32 }} Transaksi</h3>
    </div>

    <div class="bg-white p-5 rounded-xl border border-stone-200">
      <div class="flex justify-between items-start mb-3">
        <span class="w-9 h-9 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center text-sm">
          <i class="fa-solid fa-triangle-exclamation"></i>
        </span>
        <span class="text-[10px] bg-amber-50 text-amber-600 px-2 py-0.5 rounded font-semibold">Perhatian</span>
      </div>
      <p class="text-[11px] text-stone-400">Produk Stok Menipis</p>
      <h3 class="text-xl font-bold text-stone-800 mt-0.5">{{ $stokMenipis ?? 4 }} Item</h3>
    </div>
  </div>

  <!-- Tabel Transaksi Terakhir & Peringatan Stok -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Daftar Transaksi Terakhir -->
    <div class="lg:col-span-2 bg-white p-6 rounded-xl border border-stone-200">
      <div class="flex justify-between items-center mb-4">
        <div>
          <h3 class="font-bold text-sm text-stone-800">Transaksi Terakhir</h3>
          <p class="text-[11px] text-stone-400">5 transaksi terbaru pada shift Anda</p>
        </div>
        <a href="#" class="text-xs text-[#8C6D53] font-semibold hover:underline">Lihat Semua</a>
      </div>

      @php
        $transaksiTerakhir = $transaksiTerakhir ?? [
          ['kode' => 'TRX-20250512-032', 'waktu' => '14:25', 'item' => '4 Barang', 'total' => 85000, 'metode' => 'QRIS'],
          ['kode' => 'TRX-20250512-031', 'waktu' => '14:10', 'item' => '2 Barang', 'total' => 42000, 'metode' => 'Tunai'],
          ['kode' => 'TRX-20250512-030', 'waktu' => '13:48', 'item' => '7 Barang', 'total' => 164500, 'metode' => 'Tunai'],
          ['kode' => 'TRX-20250512-029', 'waktu' => '13:15', 'item' => '1 Barang', 'total' => 18000, 'metode' => 'QRIS'],
          ['kode' => 'TRX-20250512-028', 'waktu' => '12:50', 'item' => '3 Barang', 'total' => 56000, 'metode' => 'Tunai'],
        ];
      @endphp

      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-xs">
          <thead>
            <tr class="border-b border-stone-100 text-[11px] text-stone-400">
              <th class="py-2.5 font-medium">No. Struk</th>
              <th class="py-2.5 font-medium">Waktu</th>
              <th class="py-2.5 font-medium">Jumlah</th>
              <th class="py-2.5 font-medium">Metode</th>
              <th class="py-2.5 font-medium text-right">Total</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-stone-100">
            @foreach($transaksiTerakhir as $trx)
              <tr class="hover:bg-[#FAF7F2]">
                <td class="py-3 font-semibold text-stone-700">{{ $trx['kode'] }}</td>
                <td class="py-3 text-stone-500">{{ $trx['waktu'] }} WIB</td>
                <td class="py-3 text-stone-600">{{ $trx['item'] }}</td>
                <td class="py-3">
                  <span class="px-2 py-0.5 rounded text-[10px] font-medium {{ $trx['metode'] === 'QRIS' ? 'bg-sky-50 text-sky-600' : 'bg-emerald-50 text-emerald-600' }}">
                    {{ $trx['metode'] }}
                  </span>
                </td>
                <td class="py-3 text-right font-bold text-stone-800">Rp {{ number_format($trx['total'], 0, ',', '.') }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <!-- Daftar Stok Menipis -->
    <div class="bg-white p-6 rounded-xl border border-stone-200">
      <div class="mb-4">
        <h3 class="font-bold text-sm text-stone-800">Stok Hampir Habis</h3>
        <p class="text-[11px] text-stone-400">Segera infokan ke Owner untuk restock</p>
      </div>

      @php
        $barangMenipis = $barangMenipis ?? [
          ['nama' => 'Minyak Sunco 2L', 'sisa' => 3],
          ['nama' => 'Gula Pasir Gulaku 1kg', 'sisa' => 4],
          ['nama' => 'Telur Ayam Negeri 1kg', 'sisa' => 2],
          ['nama' => 'Susu UHT Full Cream 1L', 'sisa' => 5],
        ];
      @endphp

      <div class="space-y-3">
        @foreach($barangMenipis as $barang)
          <div class="flex items-center justify-between p-2.5 rounded-lg bg-[#FAF7F2] border border-stone-100 text-xs">
            <span class="font-medium text-stone-700">{{ $barang['nama'] }}</span>
            <span class="text-[11px] font-bold text-rose-600 bg-rose-50 px-2 py-0.5 rounded">
              Sisa {{ $barang['sisa'] }}
            </span>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection