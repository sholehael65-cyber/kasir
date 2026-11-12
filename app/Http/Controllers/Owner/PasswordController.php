<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function index()
    {
        // Mengambil semua user selain owner yang sedang login
        // (Jika di tabel users ada kolom 'role', bisa diganti: User::where('role', 'kasir')->get())
        $kasirs = User::where('id', '!=', Auth::id())->get();

        return view('owner.pengaturan', compact('kasirs'));
    }

    // 1. Proses Ganti Password Akun Saya (Owner)
    public function updateSelf(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'min:8', 'confirmed'],
        ], [
            'current_password.current_password' => 'Password lama tidak sesuai.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password akun Anda berhasil diperbarui!');
    }

    // 2. Proses Reset Password Kasir
    public function resetKasir(Request $request, $id)
    {
        $request->validate([
            'new_password' => ['required', 'min:8'],
        ], [
            'new_password.min' => 'Password baru kasir minimal 8 karakter.',
        ]);

        $kasir = User::findOrFail($id);
        $kasir->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', "Password untuk {$kasir->name} berhasil direset!");
    }
}