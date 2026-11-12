@extends('layouts.owner')

@section('title', 'Pengaturan & Reset Password')
@section('header-title', 'Pengaturan & Reset Password')

@section('content')
  <div>
    <h1 class="text-xl font-bold text-stone-800">Pengaturan & Reset Password</h1>
    <p class="text-xs text-stone-500 mt-1">Kelola keamanan akun Anda dan reset password kasir jika diperlukan.</p>
  </div>

  {{-- Notifikasi Sukses --}}
  @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-xs flex items-center gap-2">
      <i class="fa-solid fa-circle-check"></i>
      <span>{{ session('success') }}</span>
    </div>
  @endif

  {{-- Notifikasi Error Validasi --}}
  @if($errors->any())
    <div class="bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-xl text-xs space-y-1">
      @foreach($errors->all() as $error)
        <p><i class="fa-solid fa-circle-exclamation mr-1"></i> {{ $error }}</p>
      @endforeach
    </div>
  @endif

  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Form 1: Ganti Password Owner Sendiri -->
    <div class="bg-white p-6 rounded-xl border border-stone-200">
      <div class="mb-4">
        <h3 class="font-bold text-sm text-stone-800">Ganti Password Akun Saya</h3>
        <p class="text-[11px] text-stone-400">Pastikan menggunakan kombinasi minimal 8 karakter.</p>
      </div>

      <form action="{{ route('owner.password.updateSelf') }}" method="POST" class="space-y-4 text-xs">
        @csrf
        @method('PUT')

        <div>
          <label class="block text-stone-600 font-medium mb-1">Password Lama</label>
          <input type="password" name="current_password" required
                 class="w-full px-3 py-2 rounded-lg border border-stone-200 focus:outline-none focus:border-[#8C6D53]">
        </div>

        <div>
          <label class="block text-stone-600 font-medium mb-1">Password Baru</label>
          <input type="password" name="password" required
                 class="w-full px-3 py-2 rounded-lg border border-stone-200 focus:outline-none focus:border-[#8C6D53]">
        </div>

        <div>
          <label class="block text-stone-600 font-medium mb-1">Konfirmasi Password Baru</label>
          <input type="password" name="password_confirmation" required
                 class="w-full px-3 py-2 rounded-lg border border-stone-200 focus:outline-none focus:border-[#8C6D53]">
        </div>

        <button type="submit" class="bg-[#5B4636] hover:bg-[#49372a] text-white font-medium px-4 py-2.5 rounded-lg transition">
          Simpan Password Baru
        </button>
      </form>
    </div>

    <!-- Form 2: Reset Password Kasir -->
    <div class="bg-white p-6 rounded-xl border border-stone-200">
      <div class="mb-4">
        <h3 class="font-bold text-sm text-stone-800">Reset Password Kasir</h3>
        <p class="text-[11px] text-stone-400">Gunakan fitur ini jika petugas kasir lupa password login mereka.</p>
      </div>

      <div class="space-y-3">
        @forelse($kasirs as $kasir)
          <form action="{{ route('owner.password.resetKasir', $kasir->id) }}" method="POST" 
                class="p-3 rounded-lg border border-stone-100 bg-[#FAF7F2] flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
            @csrf
            @method('PUT')

            <div>
              <p class="font-semibold text-stone-800">{{ $kasir->name }}</p>
              <span class="text-[10px] text-stone-400">{{ $kasir->email }}</span>
            </div>

            <div class="flex items-center gap-2">
              <input type="text" name="new_password" placeholder="Password baru..." required
                     class="px-2.5 py-1.5 rounded border border-stone-200 bg-white text-xs w-36 focus:outline-none focus:border-[#8C6D53]">
              <button type="submit" class="bg-[#8C6D53] hover:bg-[#755a44] text-white px-3 py-1.5 rounded font-medium transition">
                Reset
              </button>
            </div>
          </form>
        @empty
          <p class="text-xs text-stone-400 italic">Belum ada akun kasir yang terdaftar.</p>
        @endforelse
      </div>
    </div>
  </div>
@endsection