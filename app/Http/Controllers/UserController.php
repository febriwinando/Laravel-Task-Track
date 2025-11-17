<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;

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

        return redirect()->route('users.index')->with('success', 'User created successfully.');
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


        return view('user.tambahuser', compact('user'));
    }

    /**
     * Update user
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|min:4|unique:users,name,' . $user->id,
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'level'    => 'required',
            'password' => 'nullable|min:6',
        ]);

        $data = [
            'name' => $request->name,
            'email'    => $request->email,
            'level'    => $request->level,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $data['updated_by']=auth()->id();
        $data['updated_ip']=$request->ip();

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('pegawai', 'public'); // storage/app/public/pegawai
            $data['foto'] = $path;
        }

        $user->update($data);
        
        if($user->level == "staff"){
            return redirect()->route('pegawai.index')->with('success', 'Your data has been successfully updated.');
        }

        return redirect()->route('users.index')->with('success', 'User successfully updated.');
    }

    /**
     * Hapus user
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }


    public function kirimEmail()
    {
        $data = [
            'pesan' => 'Halo! Ini adalah email dari Laravel.'
        ];

        Mail::to('nandokotank@gmail.com')->send(new ResetPasswordMail($data));

        return "Email sudah dikirim!";
    }

}
