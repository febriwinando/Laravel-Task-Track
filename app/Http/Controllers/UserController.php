<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Menampilkan daftar user
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('user.users', compact('users'));
    }

    /**
     * Halaman form input user
     */
    public function create()
    {
        return view('user.tambahuser');
    }

    /**
     * Simpan user ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:4|unique:users',
            'email'    => 'required|email|unique:users',
            'nik' => 'required',
            'employee_id' => 'required',
            'nomor_wa' => 'required',
            'level' => 'required',
            'status' => 'required|in:active,inactive',
            'inactive_reason' => 'nullable|required_if:status,inactive',
            'password' => 'required|min:8',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $validated['created_by']=auth()->id();
        $validated['created_ip']=$request->ip();

        // Simpan foto jika ada
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('pegawai', 'public'); // storage/app/public/pegawai
            $validated['foto'] = $path;
        }

        // Simpan ke database
        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User berhasil dibuat');
    }

    /**
     * Detail user
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Halaman edit user
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update user
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required|min:4|unique:users,username,' . $user->id,
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'level'    => 'required',
            'password' => 'nullable|min:6',
        ]);

        $data = [
            'username' => $request->username,
            'email'    => $request->email,
            'level'    => $request->level,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
    }

    /**
     * Hapus user
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }
}
