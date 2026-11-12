@extends('layouts.app')

@section('content')
<div class="p-8 space-y-6 overflow-y-auto">
  <!-- Judul Halaman -->
  <div>
    <h1 class="text-xl font-bold text-stone-800">Pengelolaan Data Kasir</h1>
    <p class="text-xs text-stone-500 mt-0.5">Kelola akun dan akses staf kasir.</p>
  </div>

  <!-- Action Bar: Tombol Tambah Staf -->
  <div class="flex justify-end">
    <button 
      onclick="openCashierModal()" 
      class="flex items-center gap-2 bg-[#7A604D] hover:bg-[#685141] text-white text-xs font-medium px-4 py-2.5 rounded-lg transition shadow-sm cursor-pointer"
    >
      <i class="fa-solid fa-plus text-[11px]"></i>
      <span>Tambah Staf Kasir</span>
    </button>
  </div>

  <!-- Tabel Data Staf Kasir -->
  <div class="bg-white rounded-xl border border-stone-200/80 overflow-hidden shadow-sm">
    <table class="w-full text-left border-collapse text-xs">
      <thead>
        <tr class="border-b border-stone-100 text-[10px] uppercase tracking-wider text-stone-400 bg-stone-50/50">
          <th class="py-3.5 px-6 font-semibold">ID KASIR</th>
          <th class="py-3.5 px-6 font-semibold">NAMA LENGKAP</th>
          <th class="py-3.5 px-6 font-semibold">USERNAME</th>
          <th class="py-3.5 px-6 font-semibold">EMAIL</th>
          <th class="py-3.5 px-6 font-semibold">NO. HP</th>
          <th class="py-3.5 px-6 font-semibold text-center">STATUS</th>
          <th class="py-3.5 px-6 font-semibold text-right">AKSI</th>
        </tr>
      </thead>
      <tbody id="cashier-table-body" class="divide-y divide-stone-100 text-stone-600">
        <!-- Render otomatis via JavaScript -->
      </tbody>
    </table>
  </div>
</div>

<!-- Modal Pop-up Tambah / Edit Kasir -->
<div id="cashier-modal" class="fixed inset-0 bg-black/40 backdrop-blur-xs flex items-center justify-center hidden z-50 p-4">
  <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-xl border border-stone-200 space-y-4">
    <div class="flex items-center justify-between pb-2 border-b border-stone-100">
      <h3 id="modal-title" class="font-bold text-sm text-stone-800">Tambah Staf Kasir</h3>
      <button onclick="closeCashierModal()" class="text-stone-400 hover:text-stone-600 text-sm">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <form onsubmit="handleCashierSubmit(event)" class="space-y-3 text-xs">
      <input type="hidden" id="edit-id">

      <div>
        <label class="block font-semibold text-stone-700 mb-1">Nama Lengkap</label>
        <input type="text" id="cashier-name" required placeholder="Contoh: Aulia Rahman" class="w-full px-3 py-2 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:border-[#7A604D]">
      </div>

      <div class="grid grid-cols-2 gap-3">
        <div>
          <label class="block font-semibold text-stone-700 mb-1">Username</label>
          <input type="text" id="cashier-username" required placeholder="aulia.r" class="w-full px-3 py-2 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:border-[#7A604D]">
        </div>
        <div>
          <label class="block font-semibold text-stone-700 mb-1">Status</label>
          <select id="cashier-status" class="w-full px-3 py-2 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:border-[#7A604D]">
            <option value="Aktif">Aktif</option>
            <option value="Nonaktif">Nonaktif</option>
          </select>
        </div>
      </div>

      <div>
        <label class="block font-semibold text-stone-700 mb-1">Email</label>
        <input type="email" id="cashier-email" required placeholder="aulia@kedaipos.id" class="w-full px-3 py-2 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:border-[#7A604D]">
      </div>

      <div>
        <label class="block font-semibold text-stone-700 mb-1">No. HP / WhatsApp</label>
        <input type="text" id="cashier-phone" required placeholder="0812-3456-2201" class="w-full px-3 py-2 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:border-[#7A604D]">
      </div>

      <div id="password-field">
        <label class="block font-semibold text-stone-700 mb-1">Password</label>
        <input type="password" id="cashier-password" placeholder="Minimal 6 karakter" class="w-full px-3 py-2 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:border-[#7A604D]">
      </div>

      <div class="flex justify-end gap-2 pt-3 border-t border-stone-100">
        <button type="button" onclick="closeCashierModal()" class="px-4 py-2 border border-stone-200 rounded-lg text-stone-600 hover:bg-stone-50 font-medium transition cursor-pointer">Batal</button>
        <button type="submit" class="px-4 py-2 bg-[#7A604D] hover:bg-[#685141] text-white rounded-lg font-medium transition shadow-sm cursor-pointer">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Pop-up Ganti Password Kasir (Ikon Gear) -->
<div id="password-modal" class="fixed inset-0 bg-black/40 backdrop-blur-xs flex items-center justify-center hidden z-50 p-4">
  <div class="bg-white rounded-2xl w-full max-w-sm p-6 shadow-xl border border-stone-200 space-y-4">
    <div class="flex items-center justify-between pb-2 border-b border-stone-100">
      <h3 class="font-bold text-sm text-stone-800">Reset Password Kasir</h3>
      <button onclick="closePasswordModal()" class="text-stone-400 hover:text-stone-600 text-sm">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <form onsubmit="handleResetPassword(event)" class="space-y-3 text-xs">
      <input type="hidden" id="reset-id">
      <p class="text-stone-500 text-[11px]">Ganti password akun untuk: <strong id="reset-cashier-name" class="text-stone-800"></strong></p>

      <div>
        <label class="block font-semibold text-stone-700 mb-1">Password Baru</label>
        <input type="password" id="new-password" required minlength="6" placeholder="Masukkan password baru" class="w-full px-3 py-2 border border-stone-200 rounded-lg text-stone-800 focus:outline-none focus:border-[#7A604D]">
      </div>

      <div class="flex justify-end gap-2 pt-2 border-t border-stone-100">
        <button type="button" onclick="closePasswordModal()" class="px-4 py-2 border border-stone-200 rounded-lg text-stone-600 hover:bg-stone-50 font-medium transition cursor-pointer">Batal</button>
        <button type="submit" class="px-4 py-2 bg-[#7A604D] hover:bg-[#685141] text-white rounded-lg font-medium transition shadow-sm cursor-pointer">Perbarui</button>
      </div>
    </form>
  </div>
</div>

<script>
  // Data Kasir Awal Sesuai Gambar
  let cashiers = [
    {
      id: 'KSR-001',
      name: 'Aulia Rahman',
      username: 'aulia.r',
      email: 'aulia@kedaipos.id',
      phone: '0812-3456-2201',
      status: 'Aktif'
    },
    {
      id: 'KSR-002',
      name: 'Maya Putri',
      username: 'maya.p',
      email: 'maya@kedaipos.id',
      phone: '0813-6677-9012',
      status: 'Aktif'
    },
    {
      id: 'KSR-003',
      name: 'Dimas Aditya',
      username: 'dimas.a',
      email: 'dimas@kedaipos.id',
      phone: '0821-7744-2100',
      status: 'Nonaktif'
    }
  ];

  function renderTable() {
    const tbody = document.getElementById('cashier-table-body');
    if (cashiers.length === 0) {
      tbody.innerHTML = `
        <tr>
          <td colspan="7" class="py-8 text-center text-xs text-stone-400">Belum ada akun staf kasir.</td>
        </tr>`;
      return;
    }

    tbody.innerHTML = cashiers.map(c => {
      const isAktif = c.status === 'Aktif';
      const badgeClass = isAktif 
        ? 'bg-emerald-50 text-emerald-600 border border-emerald-200/60' 
        : 'bg-rose-50 text-rose-600 border border-rose-200/60';

      return `
        <tr class="hover:bg-stone-50/60 transition">
          <td class="py-4 px-6 text-stone-400 font-medium">${c.id}</td>
          <td class="py-4 px-6 font-semibold text-stone-800">${c.name}</td>
          <td class="py-4 px-6 text-stone-500">${c.username}</td>
          <td class="py-4 px-6 text-stone-500">${c.email}</td>
          <td class="py-4 px-6 text-stone-500">${c.phone}</td>
          <td class="py-4 px-6 text-center">
            <span class="px-2.5 py-1 text-[10px] font-semibold rounded-full ${badgeClass}">${c.status}</span>
          </td>
          <td class="py-4 px-6 text-right space-x-2">
            <button onclick="editCashier('${c.id}')" class="p-1.5 text-stone-400 hover:text-stone-700 transition" title="Edit Data">
              <i class="fa-solid fa-pen text-xs"></i>
            </button>
            <button onclick="openPasswordModal('${c.id}', '${c.name}')" class="p-1.5 text-stone-400 hover:text-stone-700 transition" title="Reset Password">
              <i class="fa-solid fa-gear text-xs"></i>
            </button>
            <button onclick="deleteCashier('${c.id}')" class="p-1.5 text-rose-400 hover:text-rose-600 transition" title="Hapus">
              <i class="fa-regular fa-trash-can text-xs"></i>
            </button>
          </td>
        </tr>
      `;
    }).join('');
  }

  function openCashierModal(isEdit = false) {
    document.getElementById('cashier-modal').classList.remove('hidden');
    document.getElementById('modal-title').innerText = isEdit ? 'Edit Data Staf Kasir' : 'Tambah Staf Kasir';
    document.getElementById('password-field').style.display = isEdit ? 'none' : 'block';

    if (!isEdit) {
      document.getElementById('edit-id').value = '';
      document.getElementById('cashier-name').value = '';
      document.getElementById('cashier-username').value = '';
      document.getElementById('cashier-email').value = '';
      document.getElementById('cashier-phone').value = '';
      document.getElementById('cashier-password').value = '';
      document.getElementById('cashier-status').value = 'Aktif';
    }
  }

  function closeCashierModal() {
    document.getElementById('cashier-modal').classList.add('hidden');
  }

  function handleCashierSubmit(e) {
    e.preventDefault();
    const id = document.getElementById('edit-id').value;
    const name = document.getElementById('cashier-name').value.trim();
    const username = document.getElementById('cashier-username').value.trim();
    const email = document.getElementById('cashier-email').value.trim();
    const phone = document.getElementById('cashier-phone').value.trim();
    const status = document.getElementById('cashier-status').value;

    if (id) {
      const item = cashiers.find(c => c.id === id);
      if (item) {
        item.name = name;
        item.username = username;
        item.email = email;
        item.phone = phone;
        item.status = status;
      }
    } else {
      const nextNum = String(cashiers.length + 1).padStart(3, '0');
      cashiers.push({
        id: `KSR-${nextNum}`,
        name,
        username,
        email,
        phone,
        status
      });
    }

    closeCashierModal();
    renderTable();
    alert('Data staf kasir berhasil disimpan!');
  }

  function editCashier(id) {
    const item = cashiers.find(c => c.id === id);
    if (!item) return;

    document.getElementById('edit-id').value = item.id;
    document.getElementById('cashier-name').value = item.name;
    document.getElementById('cashier-username').value = item.username;
    document.getElementById('cashier-email').value = item.email;
    document.getElementById('cashier-phone').value = item.phone;
    document.getElementById('cashier-status').value = item.status;
    openCashierModal(true);
  }

  function deleteCashier(id) {
    if (confirm(`Yakin ingin menghapus kasir dengan ID ${id}?`)) {
      cashiers = cashiers.filter(c => c.id !== id);
      renderTable();
    }
  }

  function openPasswordModal(id, name) {
    document.getElementById('reset-id').value = id;
    document.getElementById('reset-cashier-name').innerText = name;
    document.getElementById('new-password').value = '';
    document.getElementById('password-modal').classList.remove('hidden');
  }

  function closePasswordModal() {
    document.getElementById('password-modal').classList.add('hidden');
  }

  function handleResetPassword(e) {
    e.preventDefault();
    closePasswordModal();
    alert('Password staf kasir berhasil diperbarui!');
  }

  document.addEventListener('DOMContentLoaded', () => {
    renderTable();
  });
</script>
@endsection
