<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;


class KegiatanController extends Controller
{
    public function kegiatan(){

        return view('admin.kegiatan');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kegiatans = Kegiatan::orderByDesc('id')->get();
        return view('admin.kegiatan', compact('kegiatans'));
    }

    public function create()
    {
        return view('admin.tambahkegiatan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        Kegiatan::create(
            $request->only(['task', 'keterangan', 'status']) + [
                'created_by' => auth()->id(),
                'created_ip' => $request->ip(),
            ]
        );


        return redirect()->route('kegiatan.index')
                         ->with('success', 'Task berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('admin.tambahkegiatan', compact('kegiatan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'task' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $kegiatan = Kegiatan::findOrFail($id);

        $kegiatan->update($request->only([
            'task',
            'keterangan',
            'status'
        ] + [
                'updated_by' => auth()->id(),
                'updated_ip' => $request->ip(),
            ]));

        return redirect()->route('kegiatan.index')
                         ->with('success', 'Task berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->delete();

        return redirect()->route('kegiatan.index')
                         ->with('success', 'Task berhasil dihapus!');
    }
}
