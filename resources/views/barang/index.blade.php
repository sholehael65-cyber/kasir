@extends('layouts.app')

@section('content')
<div class="p-8 space-y-6 overflow-y-auto">
  <!-- Judul & Subjudul -->
  <div>
    <h1 class="text-xl font-bold text-stone-800">Data Barang</h1>
    <p class="text-xs text-stone-500 mt-0.5">Pantau stok, harga, dan informasi seluruh produk.</p>
  </div>

  <!-- Action Bar: Pencarian, Filter Kategori, Tombol Impor & Tambah -->
  <div class="flex flex-wrap items-center justify-between gap-4">
    <div class="flex items-center gap-3 flex-1 max-w-lg">
      <input 
        type="text" 
        id="search-input" 
        placeholder="Cari nama barang..." 
        class="w-full bg-white border border-stone-200 rounded-lg px-3.5 py-2 text-xs text-stone-700 placeholder-stone-400 focus:outline-none focus:border-[#7A604D] shadow-sm"
      >
      <select 
        id="category-filter" 
        onchange="filterProducts()" 
        class="bg-white border border-stone-200 rounded-lg px-3.5 py-2 text-xs text-stone-700 focus:outline-none focus:border-[#7A604D] shadow-sm min-w-[130px]"
      >
        <option value="">Semua</option>
        <option value="Makanan">Makanan</option>
        <option value="Minuman">Minuman</option>
        <option value="Skincare">Skincare</option>
      </select>
    </div>

    <div class="flex items-center gap-2.5">
      <!-- Input File Tersembunyi untuk Impor -->
      <input type="file" id="file-import" class="hidden" accept=".csv, .xlsx" onchange="handleImport(event)">
      <button 
        type="button" 
        onclick="document.getElementById('file-import').click()" 
        class="flex items-center gap-2 bg-white border border-stone-200 hover:bg-stone-50 text-stone-700 text-xs font-medium px-4 py-2 rounded-lg transition shadow-sm cursor-pointer"
      >
        <i class="fa-solid fa-arrow-down-to-bracket text-[11px] text-stone-500"></i>
        <span>Impor Data</span>
      </button>

      <button 
        type="button" 
        onclick="openModal()" 
        class="flex items-center gap-2 bg-[#7A604D] hover:bg-[#685141] text-white text-xs font-medium px-4 py-2 rounded-lg transition shadow-sm cursor-pointer"
      >
        <i class="fa-solid fa-plus text-[11px]"></i>
        <span>Tambah Barang</span>
      </button>
    </div>
  </div>

  <!-- Tabel Data Barang -->
  <div class="bg-white rounded-xl border border-stone-200/80 overflow-hidden shadow-sm">
    <table class="w-full text-left border-collapse text-xs">
      <thead>
        <tr class="border-b border-stone-100 text-[10px] uppercase tracking-wider text-stone-400 bg-stone-50/50">
          <th class="py-3.5 px-6 font-semibold">Barang</th>
          <th class="py-3.5 px-6 font-semibold">Kategori</th>
          <th class="py-3.5 px-6 font-semibold">Stok</th>
          <th class="py-3.5 px-6 font-semibold">Satuan</th>
          <th class="py-3.5 px-6 font-semibold">Harga Beli (HPP)</th>
          <th class="py-3.5 px-6 font-semibold">Harga Jual</th>
          <th class="py-3.5 px-6 font-semibold">Status Stok</th>
          <th class="py-3.5 px-6 font-semibold text-right">Aksi</th>
        </tr>
      </thead>
      <tbody id="product-table-body" class="divide-y divide-stone-100 text-stone-600">
        <!-- Render otomatis via JavaScript -->
      </tbody>
    </table>
  </div>
</div>

<!-- Modal Pop-up Tambah / Edit Barang -->
<div id="product-modal" class="fixed inset-0 bg-black/40 backdrop-blur-xs flex items-center justify-center hidden z-50 p-4">
  <div class="bg-white rounded-2xl w-full max-w-lg p-6 shadow-xl border border-stone-200 space-y-4 max-h-[90vh] overflow-y-auto">
    <div class="flex items-center justify-between pb-3 border-b border-stone-100">
      <h3 id="modal-title" class="font-bold text-sm text-stone-800">Tambah Barang Baru</h3>
      <button onclick="closeModal()" class="text-stone-400 hover:text-stone-600 text-sm">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <form id="product-form" onsubmit="handleFormSubmit(event)" class="space-y-3.5 text-xs">
      <input type="hidden" id="edit-id">

      <div>
        <label class="block font-semibold text-stone-700 mb-1">Nama Barang</label>
        <input 
          type="text" 
          id="product-name" 
          required 
          placeholder="Contoh: Minyak Sunco 2L" 
          class="w-full px-3 py-2 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:border-[#7A604D]"
        >
      </div>

      <div class="grid grid-cols-2 gap-3">
        <div>
          <label class="block font-semibold text-stone-700 mb-1">Kategori</label>
          <select id="product-category" required class="w-full px-3 py-2 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:border-[#7A604D]">
            <option value="Makanan">Makanan</option>
            <option value="Minuman">Minuman</option>
            <option value="Skincare">Skincare</option>
          </select>
        </div>
        <div>
          <label class="block font-semibold text-stone-700 mb-1">Satuan</label>
          <input 
            type="text" 
            id="product-unit" 
            required 
            placeholder="Pouch, Botol, Karung, dll" 
            class="w-full px-3 py-2 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:border-[#7A604D]"
          >
        </div>
      </div>

      <div class="grid grid-cols-3 gap-3">
        <div>
          <label class="block font-semibold text-stone-700 mb-1">Stok</label>
          <input 
            type="number" 
            id="product-stock" 
            required 
            min="0" 
            value="0" 
            class="w-full px-3 py-2 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:border-[#7A604D]"
          >
        </div>
        <div>
          <label class="block font-semibold text-stone-700 mb-1">Harga Beli (Rp)</label>
          <input 
            type="number" 
            id="product-buy" 
            required 
            min="0" 
            placeholder="31500" 
            class="w-full px-3 py-2 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:border-[#7A604D]"
          >
        </div>
        <div>
          <label class="block font-semibold text-stone-700 mb-1">Harga Jual (Rp)</label>
          <input 
            type="number" 
            id="product-sell" 
            required 
            min="0" 
            placeholder="35000" 
            class="w-full px-3 py-2 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:border-[#7A604D]"
          >
        </div>
      </div>

      <div class="flex justify-end gap-2 pt-3 border-t border-stone-100">
        <button 
          type="button" 
          onclick="closeModal()" 
          class="px-4 py-2 border border-stone-200 rounded-lg text-stone-600 hover:bg-stone-50 font-medium transition cursor-pointer"
        >
          Batal
        </button>
        <button 
          type="submit" 
          class="px-4 py-2 bg-[#7A604D] hover:bg-[#685141] text-white rounded-lg font-medium transition shadow-sm cursor-pointer"
        >
          Simpan Barang
        </button>
      </div>
    </form>
  </div>
</div>

<script>
  // Data Barang Sesuai Gambar
  let products = [
    { id: 1, name: 'Minyak Sunco 2L', category: 'Makanan', stock: 24, unit: 'Pouch', buyPrice: 31500, sellPrice: 35000, icon: 'fa-box' },
    { id: 2, name: 'Air Le Minerale 600ml', category: 'Minuman', stock: 68, unit: 'Botol', buyPrice: 2800, sellPrice: 4000, icon: 'fa-bottle-water' },
    { id: 3, name: 'Beras Pandan Wangi 5kg', category: 'Makanan', stock: 8, unit: 'Karung', buyPrice: 68500, sellPrice: 75000, icon: 'fa-wheat-awn' },
    { id: 4, name: 'Kopi Kapal Api 165gr', category: 'Minuman', stock: 0, unit: 'Bungkus', buyPrice: 12400, sellPrice: 15000, icon: 'fa-mug-hot' },
    { id: 5, name: 'Sari Roti Tawar Kupas', category: 'Makanan', stock: 12, unit: 'Bungkus', buyPrice: 15000, sellPrice: 18000, icon: 'fa-bread-slice' },
    { id: 6, name: 'Safi Facial Wash 100ml', category: 'Skincare', stock: 17, unit: 'Tube', buyPrice: 28500, sellPrice: 34000, icon: 'fa-pump-soap' }
  ];

  function formatRp(val) {
    return 'Rp ' + Number(val).toLocaleString('id-ID');
  }

  function getStatusBadge(stock) {
    if (stock <= 0) {
      return '<span class="px-2.5 py-1 text-[10px] font-semibold rounded-full bg-rose-50 text-rose-600 border border-rose-200/50">Habis</span>';
    } else if (stock <= 10) {
      return '<span class="px-2.5 py-1 text-[10px] font-semibold rounded-full bg-amber-50 text-amber-600 border border-amber-200/50">Menipis</span>';
    } else {
      return '<span class="px-2.5 py-1 text-[10px] font-semibold rounded-full bg-emerald-50 text-emerald-600 border border-emerald-200/50">Tersedia</span>';
    }
  }

  function renderTable(data = products) {
    const tbody = document.getElementById('product-table-body');
    if (data.length === 0) {
      tbody.innerHTML = `
        <tr>
          <td colspan="8" class="py-8 text-center text-xs text-stone-400">Tidak ada barang yang cocok.</td>
        </tr>`;
      return;
    }

    tbody.innerHTML = data.map(p => `
      <tr class="hover:bg-stone-50/60 transition">
        <td class="py-4 px-6">
          <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-lg bg-stone-100 border border-stone-200 overflow-hidden flex items-center justify-center shrink-0">
              <i class="fa-solid ${p.icon || 'fa-box'} text-stone-400"></i>
            </div>
            <span class="font-semibold text-stone-800">${p.name}</span>
          </div>
        </td>
        <td class="py-4 px-6 text-stone-500">${p.category}</td>
        <td class="py-4 px-6 font-semibold text-stone-800">${p.stock}</td>
        <td class="py-4 px-6 text-stone-500">${p.unit}</td>
        <td class="py-4 px-6 text-stone-500">${formatRp(p.buyPrice)}</td>
        <td class="py-4 px-6 font-bold text-stone-800">${formatRp(p.sellPrice)}</td>
        <td class="py-4 px-6">${getStatusBadge(p.stock)}</td>
        <td class="py-4 px-6 text-right space-x-2">
          <button onclick="editProduct(${p.id})" class="p-1.5 text-stone-400 hover:text-stone-700 transition" title="Edit">
            <i class="fa-solid fa-pen text-xs"></i>
          </button>
          <button onclick="deleteProduct(${p.id})" class="p-1.5 text-rose-400 hover:text-rose-600 transition" title="Hapus">
            <i class="fa-regular fa-trash-can text-xs"></i>
          </button>
        </td>
      </tr>
    `).join('');
  }

  function openModal(isEdit = false) {
    document.getElementById('product-modal').classList.remove('hidden');
    document.getElementById('modal-title').innerText = isEdit ? 'Edit Data Barang' : 'Tambah Barang Baru';
    if (!isEdit) {
      document.getElementById('product-form').reset();
      document.getElementById('edit-id').value = '';
    }
  }

  function closeModal() {
    document.getElementById('product-modal').classList.add('hidden');
  }

  function handleFormSubmit(e) {
    e.preventDefault();
    const id = document.getElementById('edit-id').value;
    const name = document.getElementById('product-name').value.trim();
    const category = document.getElementById('product-category').value;
    const unit = document.getElementById('product-unit').value.trim();
    const stock = parseInt(document.getElementById('product-stock').value) || 0;
    const buyPrice = parseInt(document.getElementById('product-buy').value) || 0;
    const sellPrice = parseInt(document.getElementById('product-sell').value) || 0;

    if (id) {
      // Update Barang
      const item = products.find(p => p.id == id);
      if (item) {
        item.name = name;
        item.category = category;
        item.unit = unit;
        item.stock = stock;
        item.buyPrice = buyPrice;
        item.sellPrice = sellPrice;
      }
    } else {
      // Tambah Barang Baru
      products.unshift({
        id: Date.now(),
        name,
        category,
        unit,
        stock,
        buyPrice,
        sellPrice,
        icon: 'fa-box'
      });
    }

    closeModal();
    filterProducts();
  }

  function editProduct(id) {
    const item = products.find(p => p.id == id);
    if (!item) return;

    document.getElementById('edit-id').value = item.id;
    document.getElementById('product-name').value = item.name;
    document.getElementById('product-category').value = item.category;
    document.getElementById('product-unit').value = item.unit;
    document.getElementById('product-stock').value = item.stock;
    document.getElementById('product-buy').value = item.buyPrice;
    document.getElementById('product-sell').value = item.sellPrice;
    openModal(true);
  }

  function deleteProduct(id) {
    if (confirm('Yakin ingin menghapus produk ini?')) {
      products = products.filter(p => p.id !== id);
      filterProducts();
    }
  }

  function filterProducts() {
    const searchVal = document.getElementById('search-input').value.toLowerCase();
    const catVal = document.getElementById('category-filter').value;

    const filtered = products.filter(p => {
      const matchSearch = p.name.toLowerCase().includes(searchVal);
      const matchCat = catVal === '' || p.category === catVal;
      return matchSearch && matchCat;
    });

    renderTable(filtered);
  }

  function handleImport(event) {
    const file = event.target.files[0];
    if (file) {
      alert(`File "${file.name}" berhasil diunggah! Data barang siap diproses.`);
      event.target.value = '';
    }
  }

  document.getElementById('search-input').addEventListener('input', filterProducts);

  document.addEventListener('DOMContentLoaded', () => {
    renderTable();
  });
</script>
@endsection
