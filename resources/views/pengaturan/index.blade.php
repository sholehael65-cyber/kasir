@extends('layouts.app')

@section('content')
<div class="p-8 space-y-6 overflow-y-auto">
  <!-- Judul Halaman -->
  <div>
    <h1 class="text-xl font-bold text-stone-800">Pengaturan</h1>
    <p class="text-xs text-stone-500 mt-0.5">Kelola profil admin, informasi toko, dan keamanan akun.</p>
  </div>

  <!-- Baris Atas: Profil Admin & Informasi Toko -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Card Profil Admin -->
    <div class="bg-white rounded-2xl border border-stone-200/90 p-6 shadow-sm space-y-4">
      <h2 class="text-xs font-bold text-stone-800">Profil Admin</h2>

      <!-- Info Avatar Admin -->
      <div class="flex items-center gap-3 pt-1">
        <div id="admin-avatar" class="w-11 h-11 rounded-xl bg-[#8C6D53] text-white flex items-center justify-center font-bold text-sm shrink-0">
          NE
        </div>
        <div>
          <h3 id="admin-display-name" class="font-bold text-xs text-stone-800 leading-snug">Nabila El-Sholeha</h3>
          <p class="text-[10px] text-stone-400">Administrator Utama</p>
        </div>
      </div>

      <form onsubmit="handleSaveProfile(event)" class="space-y-3.5 text-xs">
        <div>
          <label class="block font-semibold text-stone-700 mb-1">Nama Lengkap</label>
          <input 
            type="text" 
            id="input-admin-name" 
            value="Nabila El-Sholeha" 
            required 
            class="w-full bg-white border border-stone-200 rounded-lg px-3.5 py-2 text-stone-800 focus:outline-none focus:border-[#7A604D] transition"
          >
        </div>

        <div>
          <label class="block font-semibold text-stone-700 mb-1">Alamat Email</label>
          <input 
            type="email" 
            id="input-admin-email" 
            value="nabila@kedaipos.id" 
            required 
            class="w-full bg-white border border-stone-200 rounded-lg px-3.5 py-2 text-stone-800 focus:outline-none focus:border-[#7A604D] transition"
          >
        </div>

        <div class="pt-1">
          <button 
            type="submit" 
            class="flex items-center gap-2 bg-[#7A604D] hover:bg-[#685141] text-white font-medium px-4 py-2 rounded-lg transition shadow-sm cursor-pointer"
          >
            <i class="fa-solid fa-check text-xs"></i>
            <span>Simpan Profil</span>
          </button>
        </div>
      </form>
    </div>

    <!-- Card Informasi Toko -->
    <div class="bg-white rounded-2xl border border-stone-200/90 p-6 shadow-sm space-y-4">
      <h2 class="text-xs font-bold text-stone-800">Informasi Toko</h2>

      <form onsubmit="handleSaveStore(event)" class="space-y-3.5 text-xs pt-1">
        <div>
          <label class="block font-semibold text-stone-700 mb-1">Nama Toko</label>
          <input 
            type="text" 
            id="input-store-name" 
            value="Kasir" 
            required 
            class="w-full bg-white border border-stone-200 rounded-lg px-3.5 py-2 text-stone-800 focus:outline-none focus:border-[#7A604D] transition"
          >
        </div>

        <div>
          <label class="block font-semibold text-stone-700 mb-1">Alamat Toko</label>
          <textarea 
            id="input-store-address" 
            rows="3" 
            required 
            class="w-full bg-white border border-stone-200 rounded-lg px-3.5 py-2 text-stone-800 focus:outline-none focus:border-[#7A604D] transition resize-none"
          >Jl. Terusan Buah Batu No. 18, Bandung, Jawa Barat</textarea>
        </div>

        <div class="pt-1">
          <button 
            type="submit" 
            class="flex items-center gap-2 bg-[#7A604D] hover:bg-[#685141] text-white font-medium px-4 py-2 rounded-lg transition shadow-sm cursor-pointer"
          >
            <i class="fa-solid fa-check text-xs"></i>
            <span>Simpan Informasi</span>
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Baris Bawah: Ubah Kata Sandi (Full Width) -->
  <div class="bg-white rounded-2xl border border-stone-200/90 p-6 shadow-sm space-y-4">
    <div>
      <h2 class="text-xs font-bold text-stone-800">Ubah Kata Sandi</h2>
      <p class="text-[11px] text-stone-500 mt-0.5">Gunakan minimal 8 karakter untuk menjaga keamanan akun.</p>
    </div>

    <form onsubmit="handleResetPassword(event)" class="space-y-3.5 text-xs max-w-3xl">
      <div>
        <label class="block font-semibold text-stone-700 mb-1">Kata Sandi Lama</label>
        <input 
          type="password" 
          id="old-password" 
          required 
          placeholder="Masukkan kata sandi lama Anda" 
          class="w-full bg-white border border-stone-200 rounded-lg px-3.5 py-2 text-stone-800 focus:outline-none focus:border-[#7A604D] transition"
        >
      </div>

      <div>
        <label class="block font-semibold text-stone-700 mb-1">Kata Sandi Baru</label>
        <input 
          type="password" 
          id="new-password" 
          required 
          minlength="8" 
          placeholder="Minimal 8 karakter" 
          class="w-full bg-white border border-stone-200 rounded-lg px-3.5 py-2 text-stone-800 focus:outline-none focus:border-[#7A604D] transition"
        >
      </div>

      <div>
        <label class="block font-semibold text-stone-700 mb-1">Konfirmasi Kata Sandi Baru</label>
        <input 
          type="password" 
          id="confirm-password" 
          required 
          minlength="8" 
          placeholder="Ulangi kata sandi baru" 
          class="w-full bg-white border border-stone-200 rounded-lg px-3.5 py-2 text-stone-800 focus:outline-none focus:border-[#7A604D] transition"
        >
      </div>

      <div class="pt-1">
        <button 
          type="submit" 
          class="bg-[#7A604D] hover:bg-[#685141] text-white font-medium px-4 py-2 rounded-lg transition shadow-sm cursor-pointer"
        >
          Perbarui Kata Sandi
        </button>
      </div>
    </form>
  </div>
</div>

<script>
  // Simpan Profil
  function handleSaveProfile(e) {
    e.preventDefault();
    const name = document.getElementById('input-admin-name').value.trim();
    const email = document.getElementById('input-admin-email').value.trim();

    if (!name || !email) {
      alert('Nama dan email tidak boleh kosong.');
      return;
    }

    // Perbarui display nama & avatar
    document.getElementById('admin-display-name').innerText = name;
    const initials = name.split(' ').map(w => w[0]).slice(0, 2).join('').toUpperCase();
    document.getElementById('admin-avatar').innerText = initials || 'AD';

    alert('Profil admin berhasil disimpan!');
  }

  // Simpan Informasi Toko
  function handleSaveStore(e) {
    e.preventDefault();
    const storeName = document.getElementById('input-store-name').value.trim();
    const storeAddress = document.getElementById('input-store-address').value.trim();

    if (!storeName || !storeAddress) {
      alert('Nama dan alamat toko tidak boleh kosong.');
      return;
    }

    alert('Informasi toko berhasil diperbarui!');
  }

  // Ubah Kata Sandi
  function handleResetPassword(e) {
    e.preventDefault();
    const oldPass = document.getElementById('old-password').value;
    const newPass = document.getElementById('new-password').value;
    const confirmPass = document.getElementById('confirm-password').value;

    if (newPass.length < 8) {
      alert('Kata sandi baru harus memiliki minimal 8 karakter!');
      return;
    }

    if (newPass !== confirmPass) {
      alert('Konfirmasi kata sandi baru tidak cocok. Harap periksa kembali!');
      return;
    }

    alert('Kata sandi berhasil diperbarui dengan aman!');
    e.target.reset();
  }
</script>
@endsection