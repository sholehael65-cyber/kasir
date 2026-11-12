@extends('layouts.app')

@section('content')
<div class="p-8 space-y-6 overflow-y-auto">
  <!-- Header Halaman -->
  <div>
    <h1 class="text-xl font-bold text-stone-800">Barang Masuk & Pemasok</h1>
    <p class="text-xs text-stone-500 mt-0.5">Catat pasokan baru dan kelola mitra pemasok.</p>
  </div>

  <!-- Tab Navigasi -->
  <div class="flex items-center gap-6 border-b border-stone-200 text-xs font-semibold">
    <button 
      id="tab-btn-masuk" 
      onclick="switchTab('masuk')" 
      class="pb-2.5 text-stone-800 border-b-2 border-[#7A604D] transition cursor-pointer"
    >
      Barang Masuk
    </button>
    <button 
      id="tab-btn-pemasok" 
      onclick="switchTab('pemasok')" 
      class="pb-2.5 text-stone-400 hover:text-stone-600 border-b-2 border-transparent transition cursor-pointer"
    >
      Data Pemasok
    </button>
  </div>

  <!-- TAB KONTEN 1: BARANG MASUK -->
  <div id="tab-content-masuk" class="space-y-6">
    <!-- Card Form Catat Barang Masuk -->
    <div class="bg-white rounded-2xl border border-stone-200/90 p-6 shadow-sm">
      <h2 class="text-xs font-bold text-stone-800 mb-4">Catat Barang Masuk</h2>

      <form onsubmit="handleFormPasokan(event)" class="space-y-4 text-xs">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <!-- Pilih Pemasok -->
          <div>
            <label class="block font-semibold text-stone-700 mb-1">Pilih Pemasok</label>
            <select id="input-supplier" required class="w-full bg-white border border-stone-200 rounded-lg px-3 py-2 text-stone-800 focus:outline-none focus:border-[#7A604D]">
              <option value="PT Sumber Makmur">PT Sumber Makmur</option>
              <option value="CV Tirta Sejahtera">CV Tirta Sejahtera</option>
            </select>
          </div>

          <!-- Pilih Barang -->
          <div>
            <label class="block font-semibold text-stone-700 mb-1">Pilih Barang</label>
            <select id="input-product" required class="w-full bg-white border border-stone-200 rounded-lg px-3 py-2 text-stone-800 focus:outline-none focus:border-[#7A604D]">
              <option value="Minyak Sunco 2L" data-price="30000" data-unit="unit">Minyak Sunco 2L</option>
              <option value="Air Le Minerale 600ml" data-price="2800" data-unit="unit">Air Le Minerale 600ml</option>
              <option value="Beras Pandan Wangi 5kg" data-price="68500" data-unit="unit">Beras Pandan Wangi 5kg</option>
            </select>
          </div>

          <!-- Tanggal Masuk -->
          <div>
            <label class="block font-semibold text-stone-700 mb-1">Tanggal Masuk</label>
            <input 
              type="date" 
              id="input-date" 
              required 
              class="w-full bg-white border border-stone-200 rounded-lg px-3 py-2 text-stone-800 focus:outline-none focus:border-[#7A604D]"
            >
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
          <!-- Jumlah Masuk -->
          <div>
            <label class="block font-semibold text-stone-700 mb-1">Jumlah Masuk</label>
            <input 
              type="number" 
              id="input-qty" 
              min="1" 
              value="10" 
              oninput="calcTotalCost()"
              required 
              class="w-full bg-white border border-stone-200 rounded-lg px-3 py-2 text-stone-800 focus:outline-none focus:border-[#7A604D]"
            >
          </div>

          <!-- Harga Beli per Unit -->
          <div>
            <label class="block font-semibold text-stone-700 mb-1">Harga Beli per Unit</label>
            <input 
              type="number" 
              id="input-unit-price" 
              min="0" 
              value="30000" 
              oninput="calcTotalCost()"
              required 
              class="w-full bg-white border border-stone-200 rounded-lg px-3 py-2 text-stone-800 focus:outline-none focus:border-[#7A604D]"
            >
          </div>

          <!-- Total Biaya (Otomatis) -->
          <div>
            <label class="block font-semibold text-stone-700 mb-1">Total Biaya</label>
            <div id="display-total-cost" class="w-full bg-[#FAF7F2] border border-stone-200 rounded-lg px-3 py-2 font-bold text-stone-800">
              Rp 300.000
            </div>
          </div>
        </div>

        <div>
          <button 
            type="submit" 
            class="flex items-center gap-2 bg-[#7A604D] hover:bg-[#685141] text-white font-medium px-4 py-2.5 rounded-lg transition shadow-sm cursor-pointer"
          >
            <i class="fa-solid fa-check text-xs"></i>
            <span>Simpan Pasokan</span>
          </button>
        </div>
      </form>
    </div>

    <!-- Tabel Riwayat Pasokan -->
    <div class="space-y-3">
      <h2 class="text-sm font-bold text-stone-800">Riwayat Pasokan</h2>
      <div class="bg-white rounded-xl border border-stone-200/80 overflow-hidden shadow-sm">
        <table class="w-full text-left border-collapse text-xs">
          <thead>
            <tr class="border-b border-stone-100 text-[10px] uppercase tracking-wider text-stone-400 bg-stone-50/50">
              <th class="py-3.5 px-6 font-semibold">TANGGAL</th>
              <th class="py-3.5 px-6 font-semibold">PEMASOK</th>
              <th class="py-3.5 px-6 font-semibold">BARANG</th>
              <th class="py-3.5 px-6 font-semibold">JUMLAH</th>
              <th class="py-3.5 px-6 font-semibold text-right">TOTAL BIAYA</th>
            </tr>
          </thead>
          <tbody id="supply-table-body" class="divide-y divide-stone-100 text-stone-600">
            <!-- Diisi lewat JavaScript -->
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- TAB KONTEN 2: DATA PEMASOK -->
  <div id="tab-content-pemasok" class="space-y-6 hidden">
    <div class="flex items-center justify-between">
      <h2 class="text-sm font-bold text-stone-800">Daftar Mitra Pemasok</h2>
      <button 
        onclick="openSupplierModal()" 
        class="flex items-center gap-2 bg-[#7A604D] hover:bg-[#685141] text-white text-xs font-medium px-4 py-2 rounded-lg transition shadow-sm cursor-pointer"
      >
        <i class="fa-solid fa-plus text-[11px]"></i>
        <span>Tambah Mitra Pemasok</span>
      </button>
    </div>

    <div class="bg-white rounded-xl border border-stone-200/80 overflow-hidden shadow-sm">
      <table class="w-full text-left border-collapse text-xs">
        <thead>
          <tr class="border-b border-stone-100 text-[10px] uppercase tracking-wider text-stone-400 bg-stone-50/50">
            <th class="py-3.5 px-6 font-semibold w-16">NO</th>
            <th class="py-3.5 px-6 font-semibold">NAMA MITRA PEMASOK</th>
            <th class="py-3.5 px-6 font-semibold">NO. KONTAK / WHATSAPP</th>
            <th class="py-3.5 px-6 font-semibold">ALAMAT</th>
            <th class="py-3.5 px-6 font-semibold text-right">AKSI</th>
          </tr>
        </thead>
        <tbody id="supplier-table-body" class="divide-y divide-stone-100 text-stone-600">
          <!-- Diisi lewat JavaScript -->
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal Pop-up Mitra Pemasok -->
<div id="supplier-modal" class="fixed inset-0 bg-black/40 backdrop-blur-xs flex items-center justify-center hidden z-50 p-4">
  <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-xl border border-stone-200 space-y-4">
    <div class="flex items-center justify-between pb-2 border-b border-stone-100">
      <h3 id="supplier-modal-title" class="font-bold text-sm text-stone-800">Tambah Mitra Pemasok</h3>
      <button onclick="closeSupplierModal()" class="text-stone-400 hover:text-stone-600 text-sm">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <form onsubmit="handleSupplierSubmit(event)" class="space-y-3.5 text-xs">
      <input type="hidden" id="edit-supplier-id">

      <div>
        <label class="block font-semibold text-stone-700 mb-1">Nama Pemasok</label>
        <input type="text" id="sup-name" required placeholder="Contoh: PT Sumber Makmur" class="w-full px-3 py-2 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:border-[#7A604D]">
      </div>

      <div>
        <label class="block font-semibold text-stone-700 mb-1">No Kontak / WhatsApp</label>
        <input type="text" id="sup-phone" required placeholder="08123456789" class="w-full px-3 py-2 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:border-[#7A604D]">
      </div>

      <div>
        <label class="block font-semibold text-stone-700 mb-1">Alamat Kantor / Gudang</label>
        <textarea id="sup-address" rows="2" placeholder="Alamat lengkap mitra" class="w-full px-3 py-2 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:border-[#7A604D]"></textarea>
      </div>

      <div class="flex justify-end gap-2 pt-2 border-t border-stone-100">
        <button type="button" onclick="closeSupplierModal()" class="px-4 py-2 border border-stone-200 rounded-lg text-stone-600 hover:bg-stone-50 font-medium transition cursor-pointer">Batal</button>
        <button type="submit" class="px-4 py-2 bg-[#7A604D] hover:bg-[#685141] text-white rounded-lg font-medium transition shadow-sm cursor-pointer">Simpan</button>
      </div>
    </form>
  </div>
</div>

<script>
  // Data Pasokan Awal Sesuai Gambar
  let supplyHistory = [
    { id: 1, date: '10 Mei 2025', supplier: 'PT Sumber Makmur', product: 'Minyak Sunco 2L', qty: 20, unit: 'unit', totalCost: 620000 },
    { id: 2, date: '08 Mei 2025', supplier: 'CV Tirta Sejahtera', product: 'Air Le Minerale 600ml', qty: 48, unit: 'unit', totalCost: 134400 },
    { id: 3, date: '05 Mei 2025', supplier: 'PT Sumber Makmur', product: 'Beras Pandan Wangi 5kg', qty: 10, unit: 'unit', totalCost: 685000 }
  ];

  // Data Mitra Pemasok Awal
  let suppliers = [
    { id: 1, name: 'PT Sumber Makmur', phone: '081234567890', address: 'Jl. Industri No. 12, Bandung' },
    { id: 2, name: 'CV Tirta Sejahtera', phone: '089876543210', address: 'Jl. Raya Cipaganti No. 45, Bandung' }
  ];

  function formatRp(val) {
    return 'Rp ' + Number(val).toLocaleString('id-ID');
  }

  // Switch Tab
  function switchTab(tab) {
    const btnMasuk = document.getElementById('tab-btn-masuk');
    const btnPemasok = document.getElementById('tab-btn-pemasok');
    const contentMasuk = document.getElementById('tab-content-masuk');
    const contentPemasok = document.getElementById('tab-content-pemasok');

    if (tab === 'masuk') {
      btnMasuk.className = "pb-2.5 text-stone-800 border-b-2 border-[#7A604D] transition cursor-pointer";
      btnPemasok.className = "pb-2.5 text-stone-400 hover:text-stone-600 border-b-2 border-transparent transition cursor-pointer";
      contentMasuk.classList.remove('hidden');
      contentPemasok.classList.add('hidden');
    } else {
      btnPemasok.className = "pb-2.5 text-stone-800 border-b-2 border-[#7A604D] transition cursor-pointer";
      btnMasuk.className = "pb-2.5 text-stone-400 hover:text-stone-600 border-b-2 border-transparent transition cursor-pointer";
      contentPemasok.classList.remove('hidden');
      contentMasuk.classList.add('hidden');
    }
  }

  // Hitung Total Biaya Otomatis
  function calcTotalCost() {
    const qty = parseFloat(document.getElementById('input-qty').value) || 0;
    const price = parseFloat(document.getElementById('input-unit-price').value) || 0;
    const total = qty * price;
    document.getElementById('display-total-cost').innerText = formatRp(total);
  }

  // Auto-fill harga beli saat barang dipilih
  document.getElementById('input-product').addEventListener('change', function(e) {
    const opt = e.target.options[e.target.selectedIndex];
    const defaultPrice = opt.getAttribute('data-price');
    if (defaultPrice) {
      document.getElementById('input-unit-price').value = defaultPrice;
      calcTotalCost();
    }
  });

  // Render Tabel Riwayat Pasokan
  function renderSupplyTable() {
    const tbody = document.getElementById('supply-table-body');
    tbody.innerHTML = supplyHistory.map(row => `
      <tr class="hover:bg-stone-50/60 transition">
        <td class="py-4 px-6 text-stone-500">${row.date}</td>
        <td class="py-4 px-6 font-semibold text-stone-800">${row.supplier}</td>
        <td class="py-4 px-6 text-stone-600">${row.product}</td>
        <td class="py-4 px-6 text-stone-600">${row.qty} ${row.unit}</td>
        <td class="py-4 px-6 text-right font-medium text-stone-800">${formatRp(row.totalCost)}</td>
      </tr>
    `).join('');
  }

  // Simpan Pasokan Baru
  function handleFormPasokan(e) {
    e.preventDefault();
    const supplier = document.getElementById('input-supplier').value;
    const productSelect = document.getElementById('input-product');
    const product = productSelect.value;
    const unit = productSelect.options[productSelect.selectedIndex].getAttribute('data-unit') || 'unit';
    const dateVal = document.getElementById('input-date').value;
    const qty = parseInt(document.getElementById('input-qty').value) || 0;
    const price = parseInt(document.getElementById('input-unit-price').value) || 0;
    const totalCost = qty * price;

    const dateObj = dateVal ? new Date(dateVal) : new Date();
    const formattedDate = dateObj.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });

    supplyHistory.unshift({
      id: Date.now(),
      date: formattedDate,
      supplier,
      product,
      qty,
      unit,
      totalCost
    });

    renderSupplyTable();
    alert('Pasokan berhasil disimpan dan tercatat ke riwayat!');
  }

  // Render Tabel Mitra Pemasok
  function renderSupplierTable() {
    const tbody = document.getElementById('supplier-table-body');
    tbody.innerHTML = suppliers.map((sup, idx) => `
      <tr class="hover:bg-stone-50/60 transition">
        <td class="py-4 px-6 text-stone-400 font-medium">${idx + 1}</td>
        <td class="py-4 px-6 font-semibold text-stone-800">${sup.name}</td>
        <td class="py-4 px-6 text-stone-600">${sup.phone}</td>
        <td class="py-4 px-6 text-stone-500">${sup.address}</td>
        <td class="py-4 px-6 text-right space-x-3">
          <button onclick="editSupplier(${sup.id})" class="text-stone-600 hover:text-stone-900 font-medium inline-flex items-center gap-1.5 transition">
            <i class="fa-solid fa-pen text-[10px]"></i> Edit
          </button>
          <button onclick="deleteSupplier(${sup.id})" class="text-rose-500 hover:text-rose-700 font-medium inline-flex items-center gap-1.5 transition">
            <i class="fa-regular fa-trash-can text-[11px]"></i> Hapus
          </button>
        </td>
      </tr>
    `).join('');

    // Update Dropdown Pemasok di Form Pasokan
    const supplierDropdown = document.getElementById('input-supplier');
    supplierDropdown.innerHTML = suppliers.map(s => `<option value="${s.name}">${s.name}</option>`).join('');
  }

  function openSupplierModal(isEdit = false) {
    document.getElementById('supplier-modal').classList.remove('hidden');
    document.getElementById('supplier-modal-title').innerText = isEdit ? 'Edit Mitra Pemasok' : 'Tambah Mitra Pemasok';
    if (!isEdit) {
      document.getElementById('edit-supplier-id').value = '';
      document.getElementById('sup-name').value = '';
      document.getElementById('sup-phone').value = '';
      document.getElementById('sup-address').value = '';
    }
  }

  function closeSupplierModal() {
    document.getElementById('supplier-modal').classList.add('hidden');
  }

  function handleSupplierSubmit(e) {
    e.preventDefault();
    const id = document.getElementById('edit-supplier-id').value;
    const name = document.getElementById('sup-name').value.trim();
    const phone = document.getElementById('sup-phone').value.trim();
    const address = document.getElementById('sup-address').value.trim();

    if (id) {
      const sup = suppliers.find(s => s.id == id);
      if (sup) {
        sup.name = name;
        sup.phone = phone;
        sup.address = address;
      }
    } else {
      suppliers.push({
        id: Date.now(),
        name,
        phone,
        address
      });
    }

    closeSupplierModal();
    renderSupplierTable();
  }

  function editSupplier(id) {
    const sup = suppliers.find(s => s.id == id);
    if (!sup) return;

    document.getElementById('edit-supplier-id').value = sup.id;
    document.getElementById('sup-name').value = sup.name;
    document.getElementById('sup-phone').value = sup.phone;
    document.getElementById('sup-address').value = sup.address;
    openSupplierModal(true);
  }

  function deleteSupplier(id) {
    if (confirm('Yakin ingin menghapus mitra pemasok ini?')) {
      suppliers = suppliers.filter(s => s.id !== id);
      renderSupplierTable();
    }
  }

  // Set tanggal default ke hari ini
  document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('input-date').value = new Date().toISOString().split('T')[0];
    calcTotalCost();
    renderSupplyTable();
    renderSupplierTable();
  });
</script>
@endsection
