<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegawais = Pegawai::all();
        return view('admin.daftaremployee', compact('pegawais'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tambahemployee');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'nik' => 'required',
            'employee_id' => 'required',
            'email' => 'required|email',
            'nomor_wa' => 'required',
            'level' => 'required',
            'status' => 'required|in:active,inactive',
            'inactive_reason' => 'nullable|required_if:status,inactive',
            'password' => 'required|confirmed|min:8',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // maksimal 2MB
        ]);

        // Simpan foto jika ada
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('pegawai', 'public'); // storage/app/public/pegawai
            $validated['foto'] = $path;
        }

        // Simpan ke database
        Pegawai::create($validated);

        return redirect()->route('pegawai.index')->with('success', 'Employee added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        return view('admin.tambahemployee', compact('pegawai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|max:20|unique:pegawais,nik,' . $pegawai->id,
            'employee_id' => 'required|string|max:20|unique:pegawais,employee_id,' . $pegawai->id,
            'email' => 'required|email|unique:pegawais,email,' . $pegawai->id,
            'nomor_wa' => 'required|string|max:20',
            'level' => 'required|string',
            'status' => 'required|string',
            'inactive_reason' => 'nullable|required_if:status,inactive',
            'password' => 'nullable|min:8|confirmed',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($pegawai->foto) {
                Storage::disk('public')->delete($pegawai->foto);
            }
            $validated['foto'] = $request->file('foto')->store('pegawai', 'public');
        }

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $pegawai->update($validated);

        return redirect()->route('pegawai.index')->with('success', 'Employee updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        if ($pegawai->foto) {
            Storage::disk('public')->delete($pegawai->foto);
        }
        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Employee deleted successfully!');
    }
}
