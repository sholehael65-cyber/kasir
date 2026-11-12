@extends('layouts.app')

@section('content')
<div class="p-8 flex gap-6 overflow-hidden h-[calc(100vh-4rem)]">
  <!-- Kolom Kiri: Katalog Produk (Bisa Scroll) -->
  <div class="flex-1 flex flex-col min-w-0 h-full overflow-hidden">
    <!-- Header Halaman -->
    <div class="mb-4 shrink-0">
      <h1 class="text-xl font-bold text-stone-800">Transaksi Kasir (POS)</h1>
      <p class="text-xs text-stone-500 mt-0.5">Pilih produk dan selesaikan transaksi pelanggan.</p>
    </div>

    <!-- Filter & Pencarian -->
    <div class="space-y-3 mb-4 shrink-0">
      <div class="relative w-full">
        <input 
          type="text" 
          id="search-input"
          placeholder="Cari produk atau pindai kode..." 
          class="w-full bg-white border border-stone-200 rounded-lg px-3.5 py-2.5 text-xs text-stone-700 placeholder-stone-400 focus:outline-none focus:border-[#7A604D] shadow-sm"
        >
      </div>

      <!-- Kategori Filter -->
      <div class="flex items-center gap-2 overflow-x-auto pb-1 text-xs">
        <button onclick="filterCategory('Semua')" class="filter-btn px-4 py-1.5 rounded-lg font-medium transition bg-[#7A604D] text-white shadow-sm" data-category="Semua">Semua</button>
        <button onclick="filterCategory('Makanan')" class="filter-btn px-4 py-1.5 rounded-lg font-medium transition bg-white border border-stone-200 text-stone-600 hover:bg-stone-50" data-category="Makanan">Makanan</button>
        <button onclick="filterCategory('Minuman')" class="filter-btn px-4 py-1.5 rounded-lg font-medium transition bg-white border border-stone-200 text-stone-600 hover:bg-stone-50" data-category="Minuman">Minuman</button>
        <button onclick="filterCategory('Skincare')" class="filter-btn px-4 py-1.5 rounded-lg font-medium transition bg-white border border-stone-200 text-stone-600 hover:bg-stone-50" data-category="Skincare">Skincare</button>
      </div>
    </div>

    <!-- Grid Card Produk -->
    <div class="flex-1 overflow-y-auto pr-2 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="product-grid">
      <!-- Produk 1 -->
      <div class="product-card bg-white rounded-xl border border-stone-200/80 p-3 flex flex-col justify-between shadow-sm hover:border-[#7A604D]/50 transition" data-name="minyak sunco 2l" data-category="Makanan">
        <div>
          <div class="h-32 w-full rounded-lg bg-stone-100 mb-3 overflow-hidden flex items-center justify-center">
            <img src="https://images.unsplash.com/photo-1589365278144-c9e705f843ba?w=500&q=80" alt="Minyak Sunco" class="h-full w-full object-cover">
          </div>
          <div class="flex items-center justify-between text-[11px] mb-1.5">
            <span class="bg-stone-100 text-stone-600 px-2 py-0.5 rounded text-[10px] font-medium">Makanan</span>
            <span class="text-stone-400">Stok 24</span>
          </div>
          <h3 class="font-bold text-xs text-stone-800 leading-snug">Minyak Sunco 2L</h3>
        </div>
        <div class="mt-3">
          <p class="font-bold text-sm text-stone-900 mb-2">Rp 35.000</p>
          <button onclick="addToCart(1, 'Minyak Sunco 2L', 35000, 24)" class="w-full py-1.5 text-xs font-semibold rounded-lg border border-stone-200 text-stone-700 hover:bg-stone-50 active:bg-stone-100 transition flex items-center justify-center gap-1.5">
            <i class="fa-solid fa-plus text-[10px]"></i> Tambah
          </button>
        </div>
      </div>

      <!-- Produk 2 -->
      <div class="product-card bg-white rounded-xl border border-stone-200/80 p-3 flex flex-col justify-between shadow-sm hover:border-[#7A604D]/50 transition" data-name="air le minerale 600ml" data-category="Minuman">
        <div>
          <div class="h-32 w-full rounded-lg bg-stone-100 mb-3 overflow-hidden flex items-center justify-center">
            <img src="https://images.unsplash.com/photo-1548839140-29a749e1bc4e?w=500&q=80" alt="Le Minerale" class="h-full w-full object-cover">
          </div>
          <div class="flex items-center justify-between text-[11px] mb-1.5">
            <span class="bg-stone-100 text-stone-600 px-2 py-0.5 rounded text-[10px] font-medium">Minuman</span>
            <span class="text-stone-400">Stok 68</span>
          </div>
          <h3 class="font-bold text-xs text-stone-800 leading-snug">Air Le Minerale 600ml</h3>
        </div>
        <div class="mt-3">
          <p class="font-bold text-sm text-stone-900 mb-2">Rp 4.000</p>
          <button onclick="addToCart(2, 'Air Le Minerale 600ml', 4000, 68)" class="w-full py-1.5 text-xs font-semibold rounded-lg border border-stone-200 text-stone-700 hover:bg-stone-50 active:bg-stone-100 transition flex items-center justify-center gap-1.5">
            <i class="fa-solid fa-plus text-[10px]"></i> Tambah
          </button>
        </div>
      </div>

      <!-- Produk 3 -->
      <div class="product-card bg-white rounded-xl border border-stone-200/80 p-3 flex flex-col justify-between shadow-sm hover:border-[#7A604D]/50 transition" data-name="beras pandan wangi 5kg" data-category="Makanan">
        <div>
          <div class="h-32 w-full rounded-lg bg-stone-100 mb-3 overflow-hidden flex items-center justify-center">
            <img src="https://images.unsplash.com/photo-1586201375761-83865001e31c?w=500&q=80" alt="Beras Pandan Wangi" class="h-full w-full object-cover">
          </div>
          <div class="flex items-center justify-between text-[11px] mb-1.5">
            <span class="bg-stone-100 text-stone-600 px-2 py-0.5 rounded text-[10px] font-medium">Makanan</span>
            <span class="text-stone-400">Stok 8</span>
          </div>
          <h3 class="font-bold text-xs text-stone-800 leading-snug">Beras Pandan Wangi 5kg</h3>
        </div>
        <div class="mt-3">
          <p class="font-bold text-sm text-stone-900 mb-2">Rp 75.000</p>
          <button onclick="addToCart(3, 'Beras Pandan Wangi 5kg', 75000, 8)" class="w-full py-1.5 text-xs font-semibold rounded-lg border border-stone-200 text-stone-700 hover:bg-stone-50 active:bg-stone-100 transition flex items-center justify-center gap-1.5">
            <i class="fa-solid fa-plus text-[10px]"></i> Tambah
          </button>
        </div>
      </div>

      <!-- Produk 4 -->
      <div class="product-card bg-white rounded-xl border border-stone-200/80 p-3 flex flex-col justify-between shadow-sm hover:border-[#7A604D]/50 transition" data-name="sari roti tawar kupas" data-category="Makanan">
        <div>
          <div class="h-32 w-full rounded-lg bg-stone-100 mb-3 overflow-hidden flex items-center justify-center">
            <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?w=500&q=80" alt="Sari Roti Tawar" class="h-full w-full object-cover">
          </div>
          <div class="flex items-center justify-between text-[11px] mb-1.5">
            <span class="bg-stone-100 text-stone-600 px-2 py-0.5 rounded text-[10px] font-medium">Makanan</span>
            <span class="text-stone-400">Stok 12</span>
          </div>
          <h3 class="font-bold text-xs text-stone-800 leading-snug">Sari Roti Tawar Kupas</h3>
        </div>
        <div class="mt-3">
          <p class="font-bold text-sm text-stone-900 mb-2">Rp 18.000</p>
          <button onclick="addToCart(4, 'Sari Roti Tawar Kupas', 18000, 12)" class="w-full py-1.5 text-xs font-semibold rounded-lg border border-stone-200 text-stone-700 hover:bg-stone-50 active:bg-stone-100 transition flex items-center justify-center gap-1.5">
            <i class="fa-solid fa-plus text-[10px]"></i> Tambah
          </button>
        </div>
      </div>

      <!-- Produk 5 -->
      <div class="product-card bg-white rounded-xl border border-stone-200/80 p-3 flex flex-col justify-between shadow-sm hover:border-[#7A604D]/50 transition" data-name="safi facial wash 100ml" data-category="Skincare">
        <div>
          <div class="h-32 w-full rounded-lg bg-stone-100 mb-3 overflow-hidden flex items-center justify-center">
            <img src="https://images.unsplash.com/photo-1556228720-195a672e8a03?w=500&q=80" alt="Safi Facial Wash" class="h-full w-full object-cover">
          </div>
          <div class="flex items-center justify-between text-[11px] mb-1.5">
            <span class="bg-stone-100 text-stone-600 px-2 py-0.5 rounded text-[10px] font-medium">Skincare</span>
            <span class="text-stone-400">Stok 17</span>
          </div>
          <h3 class="font-bold text-xs text-stone-800 leading-snug">Safi Facial Wash 100ml</h3>
        </div>
        <div class="mt-3">
          <p class="font-bold text-sm text-stone-900 mb-2">Rp 34.000</p>
          <button onclick="addToCart(5, 'Safi Facial Wash 100ml', 34000, 17)" class="w-full py-1.5 text-xs font-semibold rounded-lg border border-stone-200 text-stone-700 hover:bg-stone-50 active:bg-stone-100 transition flex items-center justify-center gap-1.5">
            <i class="fa-solid fa-plus text-[10px]"></i> Tambah
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Kolom Kanan: Panel Keranjang & Pembayaran -->
  <div class="w-96 bg-white rounded-2xl border border-stone-200/90 shadow-sm flex flex-col h-full overflow-hidden shrink-0">
    <!-- Header Keranjang -->
    <div class="p-4 border-b border-stone-100 flex items-center justify-between">
      <div>
        <h2 class="font-bold text-stone-800 text-sm">Keranjang</h2>
        <p class="text-[11px] text-stone-400" id="cart-item-count">0 item dipilih</p>
      </div>
      <button onclick="clearCart()" class="text-xs font-semibold text-rose-500 hover:text-rose-700 transition">Kosongkan</button>
    </div>

    <!-- Isi Keranjang (List Item / Empty State) -->
    <div class="flex-1 overflow-y-auto p-4 space-y-3" id="cart-container">
      <div id="cart-empty" class="h-full flex flex-col items-center justify-center text-center py-12">
        <div class="w-12 h-12 rounded-full bg-stone-100 flex items-center justify-center text-stone-400 mb-3">
          <i class="fa-solid fa-magnifying-glass text-lg"></i>
        </div>
        <p class="text-xs text-stone-400">Keranjang masih kosong</p>
      </div>
      <div id="cart-items-list" class="space-y-3 hidden"></div>
    </div>

    <!-- Form & Ringkasan Perhitungan -->
    <div class="p-4 border-t border-stone-100 bg-stone-50/40 space-y-3 text-xs">
      <!-- Input Diskon -->
      <div>
        <label class="block text-[11px] font-semibold text-stone-600 mb-1">Diskon</label>
        <div class="flex gap-2">
          <input 
            type="number" 
            id="discount-input" 
            value="0" 
            min="0"
            oninput="calculateTotal()"
            class="flex-1 bg-white border border-stone-200 rounded-lg px-3 py-1.5 text-xs text-stone-800 focus:outline-none focus:border-[#7A604D]"
          >
          <select id="discount-type" onchange="calculateTotal()" class="bg-white border border-stone-200 rounded-lg px-2 py-1.5 text-xs text-stone-700 focus:outline-none focus:border-[#7A604D]">
            <option value="rp">Rp</option>
            <option value="percent">%</option>
          </select>
        </div>
      </div>

      <!-- Subtotal & Diskon Nominal -->
      <div class="space-y-1.5 pt-1 text-stone-600">
        <div class="flex justify-between">
          <span>Subtotal</span>
          <span class="font-medium text-stone-800" id="subtotal-display">Rp 0</span>
        </div>
        <div class="flex justify-between">
          <span>Diskon</span>
          <span class="font-medium text-stone-800" id="discount-display">- Rp 0</span>
        </div>
      </div>

      <!-- Total Tagihan -->
      <div class="flex justify-between items-center pt-2 border-t border-stone-200 font-bold text-stone-800">
        <span class="text-xs">Total Pembayaran</span>
        <span class="text-base font-extrabold" id="total-display">Rp 0</span>
      </div>

      <!-- Metode Pembayaran -->
      <div>
        <label class="block text-[11px] font-semibold text-stone-600 mb-1">Metode Pembayaran</label>
        <select class="w-full bg-white border border-stone-200 rounded-lg px-3 py-2 text-xs text-stone-700 focus:outline-none focus:border-[#7A604D]">
          <option value="Tunai">Tunai</option>
          <option value="QRIS">QRIS</option>
          <option value="Transfer">Transfer Bank</option>
        </select>
      </div>

      <!-- Uang Diterima -->
      <div>
        <label class="block text-[11px] font-semibold text-stone-600 mb-1">Uang Diterima</label>
        <input 
          type="number" 
          id="cash-input" 
          placeholder="Masukkan nominal" 
          oninput="calculateTotal()"
          class="w-full bg-white border border-stone-200 rounded-lg px-3 py-2 text-xs text-stone-800 focus:outline-none focus:border-[#7A604D]"
        >
      </div>

      <!-- Kotak Kembalian -->
      <div class="p-3 bg-[#F4EDE4] rounded-xl flex items-center justify-between text-stone-800">
        <span class="font-bold text-xs">Kembalian</span>
        <span class="font-extrabold text-sm" id="change-display">Rp 0</span>
      </div>

      <!-- Tombol Selesaikan Transaksi -->
      <button 
        id="submit-order-btn"
        onclick="completeTransaction()" 
        disabled
        class="w-full py-2.5 bg-[#C5B4A4] text-white rounded-xl text-xs font-bold transition shadow-sm cursor-not-allowed"
      >
        Selesaikan Transaksi
      </button>
    </div>
  </div>
</div>

<!-- Logika Interaktif POS -->
<script>
  let cart = [];

  function formatRp(val) {
    return 'Rp ' + Number(val).toLocaleString('id-ID');
  }

  function addToCart(id, name, price, stock) {
    const existing = cart.find(item => item.id === id);
    if (existing) {
      if (existing.qty < stock) {
        existing.qty += 1;
      } else {
        alert('Stok produk telah mencapai batas maksimal.');
      }
    } else {
      cart.push({ id, name, price, stock, qty: 1 });
    }
    renderCart();
  }

  function updateQty(id, delta) {
    const item = cart.find(i => i.id === id);
    if (!item) return;

    item.qty += delta;
    if (item.qty <= 0) {
      cart = cart.filter(i => i.id !== id);
    } else if (item.qty > item.stock) {
      item.qty = item.stock;
      alert('Stok tidak mencukupi.');
    }
    renderCart();
  }

  function removeFromCart(id) {
    cart = cart.filter(item => item.id !== id);
    renderCart();
  }

  function clearCart() {
    cart = [];
    document.getElementById('cash-input').value = '';
    document.getElementById('discount-input').value = '0';
    renderCart();
  }

  function renderCart() {
    const emptyState = document.getElementById('cart-empty');
    const itemsList = document.getElementById('cart-items-list');
    const itemCount = document.getElementById('cart-item-count');

    const totalQty = cart.reduce((sum, item) => sum + item.qty, 0);
    itemCount.innerText = `${totalQty} item dipilih`;

    if (cart.length === 0) {
      emptyState.classList.remove('hidden');
      itemsList.classList.add('hidden');
      itemsList.innerHTML = '';
    } else {
      emptyState.classList.add('hidden');
      itemsList.classList.remove('hidden');

      itemsList.innerHTML = cart.map(item => `
        <div class="flex items-center justify-between p-2.5 bg-stone-50 rounded-xl border border-stone-100">
          <div class="min-w-0 pr-2">
            <h4 class="font-bold text-xs text-stone-800 truncate">${item.name}</h4>
            <p class="text-[11px] text-stone-500">${formatRp(item.price)}</p>
          </div>
          <div class="flex items-center gap-2 shrink-0">
            <button onclick="updateQty(${item.id}, -1)" class="w-6 h-6 rounded-md bg-white border border-stone-200 text-stone-600 flex items-center justify-center hover:bg-stone-100">-</button>
            <span class="text-xs font-bold text-stone-800 w-4 text-center">${item.qty}</span>
            <button onclick="updateQty(${item.id}, 1)" class="w-6 h-6 rounded-md bg-white border border-stone-200 text-stone-600 flex items-center justify-center hover:bg-stone-100">+</button>
            <button onclick="removeFromCart(${item.id})" class="text-stone-300 hover:text-rose-500 ml-1 text-xs">
              <i class="fa-regular fa-trash-can"></i>
            </button>
          </div>
        </div>
      `).join('');
    }

    calculateTotal();
  }

  function calculateTotal() {
    const subtotal = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
    const discVal = parseFloat(document.getElementById('discount-input').value) || 0;
    const discType = document.getElementById('discount-type').value;

    let discountNominal = 0;
    if (discType === 'percent') {
      discountNominal = (subtotal * discVal) / 100;
    } else {
      discountNominal = discVal;
    }

    if (discountNominal > subtotal) discountNominal = subtotal;

    const total = Math.max(0, subtotal - discountNominal);
    const cash = parseFloat(document.getElementById('cash-input').value) || 0;
    const change = Math.max(0, cash - total);

    document.getElementById('subtotal-display').innerText = formatRp(subtotal);
    document.getElementById('discount-display').innerText = `- ${formatRp(discountNominal)}`;
    document.getElementById('total-display').innerText = formatRp(total);
    document.getElementById('change-display').innerText = formatRp(change);

    const submitBtn = document.getElementById('submit-order-btn');
    if (cart.length > 0 && cash >= total && total > 0) {
      submitBtn.disabled = false;
      submitBtn.classList.remove('bg-[#C5B4A4]', 'cursor-not-allowed');
      submitBtn.classList.add('bg-[#7A604D]', 'hover:bg-[#685141]', 'cursor-pointer');
    } else {
      submitBtn.disabled = true;
      submitBtn.classList.add('bg-[#C5B4A4]', 'cursor-not-allowed');
      submitBtn.classList.remove('bg-[#7A604D]', 'hover:bg-[#685141]', 'cursor-pointer');
    }
  }

  function completeTransaction() {
    alert('Transaksi berhasil diselesaikan! Struk siap dicetak.');
    clearCart();
  }

  // Filter Kategori
  function filterCategory(cat) {
    document.querySelectorAll('.filter-btn').forEach(btn => {
      if (btn.dataset.category === cat) {
        btn.className = "filter-btn px-4 py-1.5 rounded-lg font-medium transition bg-[#7A604D] text-white shadow-sm";
      } else {
        btn.className = "filter-btn px-4 py-1.5 rounded-lg font-medium transition bg-white border border-stone-200 text-stone-600 hover:bg-stone-50";
      }
    });

    const cards = document.querySelectorAll('.product-card');
    cards.forEach(card => {
      const matchCat = (cat === 'Semua' || card.dataset.category === cat);
      card.style.display = matchCat ? 'flex' : 'none';
    });
  }

  // Pencarian Cepat
  document.getElementById('search-input').addEventListener('input', function(e) {
    const keyword = e.target.value.toLowerCase();
    const cards = document.querySelectorAll('.product-card');
    cards.forEach(card => {
      const name = card.dataset.name;
      if (name.includes(keyword)) {
        card.style.display = 'flex';
      } else {
        card.style.display = 'none';
      }
    });
  });
</script>
@endsection