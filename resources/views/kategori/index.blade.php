@extends('layouts.app')

@section('content')
<div class="p-8 space-y-6 overflow-y-auto">
  <!-- Judul Halaman -->
  <div>
    <h1 class="text-xl font-bold text-stone-800">Data Kategori</h1>
    <p class="text-xs text-stone-500 mt-0.5">Kelola pengelompokan produk di toko Anda.</p>
  </div>

  <!-- Action Bar: Pencarian & Tombol Tambah -->
  <div class="flex items-center justify-between gap-4">
    <div class="relative w-80">
      <input 
        type="text" 
        id="search-category" 
        placeholder="Cari kategori..." 
        class="w-full bg-white border border-stone-200 rounded-lg px-3.5 py-2 text-xs text-stone-700 placeholder-stone-400 focus:outline-none focus:border-[#7A604D] shadow-sm"
      >
    </div>
    <button 
      onclick="openModal()" 
      class="flex items-center gap-2 bg-[#7A604D] hover:bg-[#685141] text-white text-xs font-medium px-4 py-2.5 rounded-lg transition shadow-sm cursor-pointer"
    >
      <i class="fa-solid fa-plus text-[11px]"></i>
      <span>Tambah Kategori</span>
    </button>
  </div>

  <!-- Tabel Data Kategori -->
  <div class="bg-white rounded-xl border border-stone-200/80 overflow-hidden shadow-sm">
    <table class="w-full text-left border-collapse text-xs">
      <thead>
        <tr class="border-b border-stone-100 text-[10px] uppercase tracking-wider text-stone-400 bg-stone-50/50">
          <th class="py-3.5 px-6 font-semibold w-16">NO</th>
          <th class="py-3.5 px-6 font-semibold">NAMA KATEGORI</th>
          <th class="py-3.5 px-6 font-semibold">JUMLAH PRODUK</th>
          <th class="py-3.5 px-6 font-semibold">TANGGAL DIBUAT</th>
          <th class="py-3.5 px-6 font-semibold text-right">AKSI</th>
        </tr>
      </thead>
      <tbody id="category-table-body" class="divide-y divide-stone-100 text-stone-600">
        <!-- Baris data di-render otomatis oleh JavaScript -->
      </tbody>
    </table>
  </div>
</div>

<!-- Modal Pop-up Tambah / Edit Kategori -->
<div id="category-modal" class="fixed inset-0 bg-black/40 backdrop-blur-xs flex items-center justify-center hidden z-50">
  <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-xl border border-stone-200 space-y-4">
    <div class="flex items-center justify-between pb-2 border-b border-stone-100">
      <h3 id="modal-title" class="font-bold text-sm text-stone-800">Tambah Kategori</h3>
      <button onclick="closeModal()" class="text-stone-400 hover:text-stone-600 text-sm"><i class="fa-solid fa-xmark"></i></button>
    </div>

    <form id="category-form" onsubmit="handleFormSubmit(event)" class="space-y-4">
      <input type="hidden" id="edit-id">

      <div>
        <label class="block text-xs font-semibold text-stone-700 mb-1">Nama Kategori</label>
        <input 
          type="text" 
          id="category-name" 
          required 
          placeholder="Contoh: Snack, Minuman Dingin" 
          class="w-full px-3 py-2 border border-stone-200 rounded-lg text-xs text-stone-800 focus:outline-none focus:border-[#7A604D]"
        >
      </div>

      <div>
        <label class="block text-xs font-semibold text-stone-700 mb-1">Jumlah Produk Awal</label>
        <input 
          type="number" 
          id="category-count" 
          min="0" 
          value="0" 
          class="w-full px-3 py-2 border border-stone-200 rounded-lg text-xs text-stone-800 focus:outline-none focus:border-[#7A604D]"
        >
      </div>

      <div class="flex justify-end gap-2 pt-2 border-t border-stone-100">
        <button 
          type="button" 
          onclick="closeModal()" 
          class="px-4 py-2 border border-stone-200 rounded-lg text-xs text-stone-600 hover:bg-stone-50 font-medium transition"
        >
          Batal
        </button>
        <button 
          type="submit" 
          class="px-4 py-2 bg-[#7A604D] hover:bg-[#685141] text-white rounded-lg text-xs font-medium transition shadow-sm"
        >
          Simpan
        </button>
      </div>
    </form>
  </div>
</div>

<script>
  // Data Awal Sesuai Gambar
  let categories = [
    { id: 1, name: 'Makanan', products: 14, date: '12 Jan 2025' },
    { id: 2, name: 'Minuman', products: 9, date: '12 Jan 2025' },
    { id: 3, name: 'Skincare', products: 6, date: '04 Feb 2025' }
  ];

  function renderTable(data = categories) {
    const tbody = document.getElementById('category-table-body');
    if (data.length === 0) {
      tbody.innerHTML = `
        <tr>
          <td colspan="5" class="py-8 text-center text-xs text-stone-400">Tidak ada kategori ditemukan.</td>
        </tr>`;
      return;
    }

    tbody.innerHTML = data.map((cat, index) => `
      <tr class="hover:bg-stone-50/60 transition">
        <td class="py-4 px-6 text-stone-400 font-medium">${index + 1}</td>
        <td class="py-4 px-6 font-semibold text-stone-800">${cat.name}</td>
        <td class="py-4 px-6 text-stone-500">${cat.products} produk</td>
        <td class="py-4 px-6 text-stone-500">${cat.date}</td>
        <td class="py-4 px-6 text-right space-x-3">
          <button onclick="editCategory(${cat.id})" class="text-stone-600 hover:text-stone-900 font-medium inline-flex items-center gap-1.5 transition">
            <i class="fa-solid fa-pen text-[10px]"></i> Edit
          </button>
          <button onclick="deleteCategory(${cat.id})" class="text-rose-500 hover:text-rose-700 font-medium inline-flex items-center gap-1.5 transition">
            <i class="fa-regular fa-trash-can text-[11px]"></i> Hapus
          </button>
        </td>
      </tr>
    `).join('');
  }

  function openModal(isEdit = false) {
    document.getElementById('category-modal').classList.remove('hidden');
    document.getElementById('modal-title').innerText = isEdit ? 'Edit Kategori' : 'Tambah Kategori';
    if (!isEdit) {
      document.getElementById('category-form').reset();
      document.getElementById('edit-id').value = '';
    }
  }

  function closeModal() {
    document.getElementById('category-modal').classList.add('hidden');
  }

  function handleFormSubmit(e) {
    e.preventDefault();
    const id = document.getElementById('edit-id').value;
    const name = document.getElementById('category-name').value.trim();
    const count = parseInt(document.getElementById('category-count').value) || 0;

    if (id) {
      // Mode Edit
      const item = categories.find(c => c.id == id);
      if (item) {
        item.name = name;
        item.products = count;
      }
    } else {
      // Mode Tambah Baru
      const today = new Date();
      const options = { day: '2-digit', month: 'short', year: 'numeric' };
      const formattedDate = today.toLocaleDateString('id-ID', options);

      categories.push({
        id: Date.now(),
        name: name,
        products: count,
        date: formattedDate
      });
    }

    closeModal();
    renderTable();
  }

  function editCategory(id) {
    const item = categories.find(c => c.id == id);
    if (!item) return;

    document.getElementById('edit-id').value = item.id;
    document.getElementById('category-name').value = item.name;
    document.getElementById('category-count').value = item.products;
    openModal(true);
  }

  function deleteCategory(id) {
    if (confirm('Yakin ingin menghapus kategori ini?')) {
      categories = categories.filter(c => c.id !== id);
      renderTable();
    }
  }

  // Real-time Search
  document.getElementById('search-category').addEventListener('input', function(e) {
    const query = e.target.value.toLowerCase();
    const filtered = categories.filter(c => c.name.toLowerCase().includes(query));
    renderTable(filtered);
  });

  // Render awal saat halaman dimuat
  document.addEventListener('DOMContentLoaded', () => {
    renderTable();
  });
</script>
@endsection
