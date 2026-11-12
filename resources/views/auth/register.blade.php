@extends('layouts.app')

@section('content')
<div class="flex-1 p-8 flex items-center justify-center">
    <div class="w-full max-w-md bg-white rounded-xl shadow-sm border border-stone-200 p-6">
        <h2 class="text-xl font-bold text-stone-800 mb-6 text-center">Registrasi Akun Baru</h2>
        
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            
            <div>
                <label class="block text-xs font-semibold text-stone-600 mb-1">Nama</label>
                <input type="text" name="name" required class="w-full px-3 py-2 border border-stone-300 rounded-lg text-sm focus:outline-none focus:border-[#8C6D53]">
            </div>

            <div>
                <label class="block text-xs font-semibold text-stone-600 mb-1">Email</label>
                <input type="email" name="email" required class="w-full px-3 py-2 border border-stone-300 rounded-lg text-sm focus:outline-none focus:border-[#8C6D53]">
            </div>

            <div>
                <label class="block text-xs font-semibold text-stone-600 mb-1">Password</label>
                <input type="password" name="password" required class="w-full px-3 py-2 border border-stone-300 rounded-lg text-sm focus:outline-none focus:border-[#8C6D53]">
            </div>

            <div>
                <label class="block text-xs font-semibold text-stone-600 mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required class="w-full px-3 py-2 border border-stone-300 rounded-lg text-sm focus:outline-none focus:border-[#8C6D53]">
            </div>

            <button type="submit" class="w-full py-2.5 bg-[#8C6D53] hover:bg-[#725740] text-white rounded-lg font-medium text-sm transition">
                Daftar
            </button>
        </form>
    </div>
</div>
@endsection