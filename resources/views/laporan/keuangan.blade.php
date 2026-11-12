@extends('layouts.app')

@section('content')
<div class="p-8 space-y-6 overflow-y-auto">
  <!-- Judul Halaman -->
  <div>
    <h1 class="text-xl font-bold text-stone-800">Laporan Keuangan</h1>
    <p class="text-xs text-stone-500 mt-0.5">Analisis pemasukan, pengeluaran, dan laba toko.</p>
  </div>

  <!-- Filter & Tombol Unduh -->
  <div class="flex flex-wrap items-end justify-between gap-4">
    <div class="flex flex-wrap items-end gap-3 text-xs">
      <div>
        <label class="block text-[11px] font-semibold text-stone-600 mb-1">Rentang Tanggal</label>
        <select id="filter-range" class="bg-white border border-stone-200 rounded-lg px-3 py-2 text-stone-700 focus:outline-none focus:border-[#7A604D] min-w-[140px] shadow-sm">
          <option value="bulan_ini">Bulan ini</option>
          <option value="hari_ini">Hari ini</option>
          <option value="minggu_ini">Minggu ini</option>
          <option value="semua">Semua Periode</option>
        </select>
      </div>

      <div>
        <label class="block text-[11px] font-semibold text-stone-600 mb-1">Kategori</label>
        <select id="filter-category" class="bg-white border border-stone-200 rounded-lg px-3 py-2 text-stone-700 focus:outline-none focus:border-[#7A604D] min-w-[150px] shadow-sm">
          <option value="Semua">Semua Kategori</option>
          <option value="Makanan">Makanan</option>
          <option value="Minuman">Minuman</option>
          <option value="Skincare">Skincare</option>
          <option value="Pengeluaran">Pengeluaran Stok</option>
        </select>
      </div>

      <button 
        onclick="applyFilter()" 
        class="bg-[#7A604D] hover:bg-[#685141] text-white font-medium px-4 py-2 rounded-lg transition shadow-sm cursor-pointer"
      >
        Terapkan Filter
      </button>
    </div>

    <!-- Tombol Unduh Laporan -->
    <button 
      onclick="exportReportToCSV()" 
      class="flex items-center gap-2 bg-white border border-stone-200 hover:bg-stone-50 text-stone-700 text-xs font-medium px-4 py-2 rounded-lg transition shadow-sm cursor-pointer"
    >
      <i class="fa-solid fa-arrow-down-to-bracket text-[11px] text-stone-500"></i>
      <span>Unduh Laporan</span>
    </button>
  </div>

  <!-- Kartu Metrik Keuangan -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
    <!-- Total Pemasukan -->
    <div class="bg-white rounded-2xl border border-stone-200/90 p-5 shadow-sm space-y-1.5">
      <div class="flex items-center gap-2 text-xs font-semibold text-stone-600">
        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
        <span>Total Pemasukan</span>
      </div>
      <div class="text-2xl font-bold text-stone-900" id="stat-revenue">Rp 18.750.000</div>
      <p class="text-[10px] text-stone-400">Periode berjalan</p>
    </div>

    <!-- Total Pengeluaran Stok -->
    <div class="bg-white rounded-2xl border border-stone-200/90 p-5 shadow-sm space-y-1.5">
      <div class="flex items-center gap-2 text-xs font-semibold text-stone-600">
        <span class="w-2 h-2 rounded-full bg-rose-500"></span>
        <span>Total Pengeluaran Stok</span>
      </div>
      <div class="text-2xl font-bold text-stone-900" id="stat-expense">Rp 12.325.000</div>
      <p class="text-[10px] text-stone-400">Periode berjalan</p>
    </div>

    <!-- Laba Bersih -->
    <div class="bg-white rounded-2xl border border-stone-200/90 p-5 shadow-sm space-y-1.5">
      <div class="flex items-center gap-2 text-xs font-semibold text-stone-600">
        <span class="w-2 h-2 rounded-full bg-stone-500"></span>
        <span>Laba Bersih</span>
      </div>
      <div class="text-2xl font-bold text-stone-900" id="stat-profit">Rp 6.425.000</div>
      <p class="text-[10px] text-stone-400">Periode berjalan</p>
    </div>
  </div>

  <!-- Tabel Rincian Laporan Keuangan -->
  <div class="bg-white rounded-xl border border-stone-200/80 overflow-hidden shadow-sm">
    <table class="w-full text-left border-collapse text-xs">
      <thead>
        <tr class="border-b border-stone-100 text-[10px] uppercase tracking-wider text-stone-400 bg-stone-50/50">
          <th class="py-3.5 px-6 font-semibold">TANGGAL</th>
          <th class="py-3.5 px-6 font-semibold">NAMA BARANG</th>
          <th class="py-3.5 px-6 font-semibold">KATEGORI</th>
          <th class="py-3.5 px-6 font-semibold">JUMLAH TERJUAL</th>
          <th class="py-3.5 px-6 font-semibold">HARGA BELI</th>
          <th class="py-3.5 px-6 font-semibold">HARGA JUAL</th>
          <th class="py-3.5 px-6 font-semibold">MARGIN/LABA</th>
          <th class="py-3.5 px-6 font-semibold text-center">ARUS KAS</th>
        </tr>
      </thead>
      <tbody id="report-table-body" class="divide-y divide-stone-100 text-stone-600">
        <!-- Render otomatis via JavaScript -->
      </tbody>
    </table>
  </div>
</div>

<script>
  // Data Keuangan Awal Sesuai Gambar
  const financialRecords = [
    {
      date: '12 Mei 2025',
      name: 'Minyak Sunco 2L',
      category: 'Makanan',
      qtySold: 8,
      buyPrice: 252000,
      sellPrice: 280000,
      margin: 28000,
      type: 'Masuk'
    },
    {
      date: '12 Mei 2025',
      name: 'Air Le Minerale 600ml',
      category: 'Minuman',
      qtySold: 24,
      buyPrice: 67200,
      sellPrice: 96000,
      margin: 28800,
      type: 'Masuk'
    },
    {
      date: '11 Mei 2025',
      name: 'Beras Pandan Wangi 5kg',
      category: 'Makanan',
      qtySold: 5,
      buyPrice: 342500,
      sellPrice: 375000,
      margin: 32500,
      type: 'Masuk'
    },
    {
      date: '10 Mei 2025',
      name: 'Pembelian stok',
      category: 'Pengeluaran',
      qtySold: null,
      buyPrice: 620000,
      sellPrice: 0,
      margin: -620000,
      type: 'Keluar'
    }
  ];

  function formatRp(val) {
    if (val < 0) {
      return '- Rp ' + Number(Math.abs(val)).toLocaleString('id-ID');
    }
    return 'Rp ' + Number(val).toLocaleString('id-ID');
  }

  function renderTable(data) {
    const tbody = document.getElementById('report-table-body');
    if (data.length === 0) {
      tbody.innerHTML = `
        <tr>
          <td colspan="8" class="py-8 text-center text-xs text-stone-400">Tidak ada riwayat transaksi pada filter ini.</td>
        </tr>`;
      return;
    }

    tbody.innerHTML = data.map(item => {
      const isKeluar = item.type === 'Keluar';
      const marginColor = isKeluar ? 'text-rose-600' : 'text-emerald-600 font-medium';
      const badgeClass = isKeluar 
        ? 'bg-rose-50 text-rose-600 border border-rose-200/60' 
        : 'bg-emerald-50 text-emerald-600 border border-emerald-200/60';

      return `
        <tr class="hover:bg-stone-50/60 transition">
          <td class="py-4 px-6 text-stone-500">${item.date}</td>
          <td class="py-4 px-6 font-semibold text-stone-800">${item.name}</td>
          <td class="py-4 px-6 text-stone-500">${item.category === 'Pengeluaran' ? '—' : item.category}</td>
          <td class="py-4 px-6 text-stone-600">${item.qtySold !== null ? item.qtySold : '—'}</td>
          <td class="py-4 px-6 text-stone-500">${formatRp(item.buyPrice)}</td>
          <td class="py-4 px-6 text-stone-600">${formatRp(item.sellPrice)}</td>
          <td class="py-4 px-6 ${marginColor}">${formatRp(item.margin)}</td>
          <td class="py-4 px-6 text-center">
            <span class="px-2.5 py-1 text-[10px] font-semibold rounded-full ${badgeClass}">${item.type}</span>
          </td>
        </tr>
      `;
    }).join('');
  }

  function applyFilter() {
    const selectedCat = document.getElementById('filter-category').value;
    let filtered = financialRecords;

    if (selectedCat !== 'Semua') {
      filtered = financialRecords.filter(item => item.category === selectedCat);
    }

    renderTable(filtered);
  }

  // Unduh data tabel ke file CSV
  function exportReportToCSV() {
    let csv = "TANGGAL,NAMA BARANG,KATEGORI,JUMLAH TERJUAL,HARGA BELI,HARGA JUAL,MARGIN/LABA,ARUS KAS\n";
    financialRecords.forEach(row => {
      const cat = row.category === 'Pengeluaran' ? '-' : row.category;
      const qty = row.qtySold !== null ? row.qtySold : '-';
      csv += `"${row.date}","${row.name}","${cat}","${qty}","${row.buyPrice}","${row.sellPrice}","${row.margin}","${row.type}"\n`;
    });

    const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement("a");
    const url = URL.createObjectURL(blob);
    link.setAttribute("href", url);
    link.setAttribute("download", "Laporan_Keuangan.csv");
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  }

  document.addEventListener('DOMContentLoaded', () => {
    renderTable(financialRecords);
  });
</script>
@endsection
