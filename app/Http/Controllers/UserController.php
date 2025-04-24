<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10); 
        return view('petugas', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'admin' => 'required|boolean', // Validasi admin sebagai boolean
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'admin' => $request->admin, // Simpan admin
        ]);

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil ditambahkan.');
    }
    public function create()
    {
        return view('CRUD.petugas.cu-petugas'); // Tampilkan form tambah petugas
    }

    public function edit(User $petuga)
    {
        return view('CRUD.petugas.cu-petugas', compact('petuga')); // Tampilkan form edit petugas
    }

    public function update(Request $request, User $petuga)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $petuga->id,
            'password' => 'nullable|string|min:8|confirmed',
            'admin' => 'required|boolean', // Validasi admin sebagai boolean
        ]);

        $petuga->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $petuga->password,
            'admin' => $request->admin, // Perbarui admin
    ]);

    return redirect()->route('petugas.index')->with('success', 'Petugas berhasil diperbarui.');
}

    public function destroy(User $petuga)
    {
        $petuga->delete();
        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil dihapus.');
    }
}