<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Schedule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{

    public function byPegawai($pegawai_id)
    {
        $data = Schedule::with([
            'pegawai',
            'kegiatan',
            'lokasi',
            'creator',
            'updater'
        ])
        ->where('pegawai_id', $pegawai_id)
        ->orderBy('tanggal', 'ASC')
        ->get();

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|max:20|unique:pegawais',
            'employee_id' => 'required|string|max:20|unique:pegawais',
            'email' => 'required|email|unique:pegawais',
            'nomor_wa' => 'required|string|max:20',
            'level' => 'required|string',
            'status' => 'required|string',
            'password' => 'required|min:8|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $pegawai = Pegawai::create($validated);

        $token = $pegawai->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Registration successful',
            'pegawai' => $pegawai,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $pegawai = Pegawai::where('employee_id', $request->employee_id)->first();

        if (! $pegawai || ! Hash::check($request->password, $pegawai->password)) {
            throw ValidationException::withMessages([
                'employee_id' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $pegawai->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'pegawai' => $pegawai,
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }


    public function index()
    {
        return response()->json(Pegawai::all());
    }

    public function show($id)
    {
        return response()->json(Pegawai::findOrFail($id));
    }

    public function store(Request $request)
    {
        $pegawai = Pegawai::create($request->all());
        return response()->json($pegawai, 201);
    }

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

        // Deteksi apakah ini API atau Web
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Employee updated successfully',
                'pegawai' => $pegawai,
            ]);
        }

        return redirect()->route('pegawai.index')->with('success', 'Employee updated successfully!');
    }


    public function destroy($id)
    {
        Pegawai::destroy($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
