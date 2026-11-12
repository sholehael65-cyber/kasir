@extends('layouts.app')

@section('content')
<div class="p-8 space-y-6 overflow-y-auto">
  <!-- Judul Halaman -->
  <div>
    <h1 class="text-xl font-bold text-stone-800">Arus Kas</h1>
    <p class="text-xs text-stone-500 mt-0.5">Pantau seluruh pergerakan kas masuk dan keluar.</p>
  </div>

  <!-- Kartu Metrik Ringkasan Kas -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
    <!-- Total Kas Masuk -->
    <div class="bg-white rounded-2xl border border-stone-200/90 p-5 shadow-sm space-y-1.5">
      <div class="flex items-center gap-2 text-xs font-semibold text-stone-600">
        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
        <span>Total Kas Masuk</span>
      </div>
      <div class="text-2xl font-bold text-stone-900" id="stat-cash-in">Rp 28.450.000</div>
      <p class="text-[10px] text-stone-400">Periode berjalan</p>
    </div>

    <!-- Total Kas Keluar -->
    <div class="bg-white rounded-2xl border border-stone-200/90 p-5 shadow-sm space-y-1.5">
      <div class="flex items-center gap-2 text-xs font-semibold text-stone-600">
        <span class="w-2 h-2 rounded-full bg-rose-500"></span>
        <span>Total Kas Keluar</span>
      </div>
      <div class="text-2xl font-bold text-stone-900" id="stat-cash-out">Rp 11.275.000</div>
      <p class="text-[10px] text-stone-400">Periode berjalan</p>
    </div>

    <!-- Saldo Saat Ini -->
    <div class="bg-white rounded-2xl border border-stone-200/90 p-5 shadow-sm space-y-1.5">
      <div class="flex items-center gap-2 text-xs font-semibold text-stone-600">
        <span class="w-2 h-2 rounded-full bg-stone-700"></span>
        <span>Saldo Saat Ini</span>
      </div>
      <div class="text-2xl font-bold text-stone-900" id="stat-balance">Rp 17.175.000</div>
      <p class="text-[10px] text-stone-400">Periode berjalan</p>
    </div>
  </div>

  <!-- Header Mutasi Kas & Filter Tanggal -->
  <div class="flex flex-wrap items-end justify-between gap-4 pt-2">
    <div class="flex items-center gap-3">
      <h2 class="text-sm font-bold text-stone-800">Mutasi Kas</h2>
      <button 
        onclick="openModal()" 
        class="flex items-center gap-1.5 bg-[#7A604D] hover:bg-[#685141] text-white text-[11px] font-medium px-3 py-1.5 rounded-lg transition shadow-sm cursor-pointer"
      >
        <i class="fa-solid fa-plus text-[10px]"></i>
        <span>Catat Mutasi</span>
      </button>
    </div>

    <div class="flex flex-col items-end">
      <label class="block text-[11px] font-semibold text-stone-600 mb-1">Filter Tanggal</label>
      <div class="flex items-center gap-2">
        <input 
          type="date" 
          id="filter-date" 
          onchange="filterByDate()" 
          class="bg-white border border-stone-200 rounded-lg px-3 py-1.5 text-xs text-stone-700 focus:outline-none focus:border-[#7A604D] shadow-sm min-w-[150px]"
        >
        <button 
          onclick="resetDateFilter()" 
          title="Reset filter" 
          class="p-2 text-stone-400 hover:text-stone-700 text-xs transition"
        >
          <i class="fa-solid fa-rotate-left"></i>
        </button>
      </div>
    </div>
  </div>

  <!-- Tabel Riwayat Mutasi Kas -->
  <div class="bg-white rounded-xl border border-stone-200/80 overflow-hidden shadow-sm">
    <table class="w-full text-left border-collapse text-xs">
      <thead>
        <tr class="border-b border-stone-100 text-[10px] uppercase tracking-wider text-stone-400 bg-stone-50/50">
          <th class="py-3.5 px-6 font-semibold">TANGGAL</th>
          <th class="py-3.5 px-6 font-semibold">KETERANGAN</th>
          <th class="py-3.5 px-6 font-semibold">REFERENSI</th>
          <th class="py-3.5 px-6 font-semibold text-center">JENIS</th>
          <th class="py-3.5 px-6 font-semibold text-right">NOMINAL</th>
        </tr>
      </thead>
      <tbody id="cashflow-table-body" class="divide-y divide-stone-100 text-stone-600">
        <!-- Render otomatis via JavaScript -->
      </tbody>
    </table>
  </div>
</div>

<!-- Modal Pop-up Tambah Mutasi Kas -->
<div id="cashflow-modal" class="fixed inset-0 bg-black/40 backdrop-blur-xs flex items-center justify-center hidden z-50 p-4">
  <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-xl border border-stone-200 space-y-4">
    <div class="flex items-center justify-between pb-2 border-b border-stone-100">
      <h3 class="font-bold text-sm text-stone-800">Catat Mutasi Kas Baru</h3>
      <button onclick="closeModal()" class="text-stone-400 hover:text-stone-600 text-sm">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <form onsubmit="handleMutationSubmit(event)" class="space-y-3.5 text-xs">
      <div>
        <label class="block font-semibold text-stone-700 mb-1">Tanggal</label>
        <input type="date" id="input-date" required class="w-full px-3 py-2 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:border-[#7A604D]">
      </div>

      <div>
        <label class="block font-semibold text-stone-700 mb-1">Keterangan</label>
        <input type="text" id="input-desc" required placeholder="Contoh: Pembayaran listrik / Penjualan harian" class="w-full px-3 py-2 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:border-[#7A604D]">
      </div>

      <div class="grid grid-cols-2 gap-3">
        <div>
          <label class="block font-semibold text-stone-700 mb-1">Jenis Kas</label>
          <select id="input-type" class="w-full px-3 py-2 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:border-[#7A604D]">
            <option value="Masuk">Kas Masuk</option>
            <option value="Keluar">Kas Keluar</option>
          </select>
        </div>
        <div>
          <label class="block font-semibold text-stone-700 mb-1">No. Referensi</label>
          <input type="text" id="input-ref" placeholder="TRX-XXXX / SUP-XXXX" class="w-full px-3 py-2 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:border-[#7A604D]">
        </div>
      </div>

      <div>
        <label class="block font-semibold text-stone-700 mb-1">Nominal (Rp)</label>
        <input type="number" id="input-nominal" required min="1" placeholder="500000" class="w-full px-3 py-2 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:border-[#7A604D]">
      </div>

      <div class="flex justify-end gap-2 pt-2 border-t border-stone-100">
        <button type="button" onclick="closeModal()" class="px-4 py-2 border border-stone-200 rounded-lg text-stone-600 hover:bg-stone-50 font-medium transition cursor-pointer">Batal</button>
        <button type="submit" class="px-4 py-2 bg-[#7A604D] hover:bg-[#685141] text-white rounded-lg font-medium transition shadow-sm cursor-pointer">Simpan Mutasi</button>
      </div>
    </form>
  </div>
</div>

<script>
  // Data Mutasi Kas Awal Sesuai Gambar
  let cashflows = [
    {
      id: 1,
      dateStr: '12 Mei 2025',
      dateIso: '2025-05-12',
      desc: 'Penjualan harian',
      ref: 'TRX-120525',
      type: 'Masuk',
      amount: 2450000
    },
    {
      id: 2,
      dateStr: '12 Mei 2025',
      dateIso: '2025-05-12',
      desc: 'Pembelian stok minyak',
      ref: 'SUP-0192',
      type: 'Keluar',
      amount: 620000
    },
    {
      id: 3,
      dateStr: '11 Mei 2025',
      dateIso: '2025-05-11',
      desc: 'Penjualan harian',
      ref: 'TRX-110525',
      type: 'Masuk',
      amount: 1985000
    }
  ];

  function formatRp(val) {
    return 'Rp ' + Number(val).toLocaleString('id-ID');
  }

  function renderTable(data = cashflows) {
    const tbody = document.getElementById('cashflow-table-body');
    if (data.length === 0) {
      tbody.innerHTML = `
        <tr>
          <td colspan="5" class="py-8 text-center text-xs text-stone-400">Tidak ada mutasi kas pada tanggal ini.</td>
        </tr>`;
      return;
    }

    tbody.innerHTML = data.map(item => {
      const isMasuk = item.type === 'Masuk';
      const badgeClass = isMasuk 
        ? 'bg-emerald-50 text-emerald-600 border border-emerald-200/60' 
        : 'bg-rose-50 text-rose-600 border border-rose-200/60';
      const nominalClass = isMasuk ? 'text-emerald-600 font-bold' : 'text-rose-600 font-bold';
      const prefix = isMasuk ? '+ ' : '- ';

      return `
        <tr class="hover:bg-stone-50/60 transition">
          <td class="py-4 px-6 text-stone-500">${item.dateStr}</td>
          <td class="py-4 px-6 font-semibold text-stone-800">${item.desc}</td>
          <td class="py-4 px-6 text-stone-500">${item.ref || '—'}</td>
          <td class="py-4 px-6 text-center">
            <span class="px-2.5 py-1 text-[10px] font-semibold rounded-full ${badgeClass}">${item.type}</span>
          </td>
          <td class="py-4 px-6 text-right ${nominalClass}">${prefix}${formatRp(item.amount)}</td>
        </tr>
      `;
    }).join('');
  }

  function openModal() {
    document.getElementById('cashflow-modal').classList.remove('hidden');
    document.getElementById('input-date').value = new Date().toISOString().split('T')[0];
    document.getElementById('input-desc').value = '';
    document.getElementById('input-nominal').value = '';
    document.getElementById('input-ref').value = 'TRX-' + Math.floor(100000 + Math.random() * 900000);
  }

  function closeModal() {
    document.getElementById('cashflow-modal').classList.add('hidden');
  }

  function handleMutationSubmit(e) {
    e.preventDefault();
    const dateVal = document.getElementById('input-date').value;
    const desc = document.getElementById('input-desc').value.trim();
    const type = document.getElementById('input-type').value;
    const ref = document.getElementById('input-ref').value.trim();
    const amount = parseInt(document.getElementById('input-nominal').value) || 0;

    const dateObj = dateVal ? new Date(dateVal) : new Date();
    const formattedDate = dateObj.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });

    cashflows.unshift({
      id: Date.now(),
      dateStr: formattedDate,
      dateIso: dateVal,
      desc,
      ref,
      type,
      amount
    });

    closeModal();
    renderTable();
    alert('Mutasi kas berhasil ditambahkan!');
  }

  function filterByDate() {
    const selectedDate = document.getElementById('filter-date').value;
    if (!selectedDate) {
      renderTable(cashflows);
      return;
    }
    const filtered = cashflows.filter(item => item.dateIso === selectedDate);
    renderTable(filtered);
  }

  function resetDateFilter() {
    document.getElementById('filter-date').value = '';
    renderTable(cashflows);
  }

  document.addEventListener('DOMContentLoaded', () => {
    renderTable();
  });
</script>
@endsection