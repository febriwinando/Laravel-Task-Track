<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Kegiatan;
use App\Models\Schedule;


class JadwalController extends Controller
{
    // GET DATA FOR MODAL
    public function getKegiatan($tanggal)
    {
        $kegiatan = Kegiatan::all();
        $pegawai  = Pegawai::select('id', 'name')->get();

        return response()->json([
            'task_list' => $kegiatan,
            'pegawai'   => $pegawai
        ]);
    }

    // STORE SCHEDULE
    public function storeKegiatan(Request $request)
    {
        $tanggal    = $request->tanggal;
        $pegawai_id = $request->pegawai_id;
        $ids        = $request->kegiatan_ids ?? [];

        // Hapus schedule lama pegawai tsb pada tanggal tsb
        Schedule::where('tanggal', $tanggal)
            ->where('pegawai_id', $pegawai_id)
            ->delete();

        // Insert schedule baru
        foreach ($ids as $id) {
            Schedule::create([
                'tanggal'     => $tanggal,
                'pegawai_id'  => $pegawai_id,
                'kegiatan_id' => $id
            ]);
        }

        return response()->json(['success' => true]);
    }


    public function getKegiatanByDate($tanggal, $pegawai_id)
    {
        $task_list = Kegiatan::all();

        // kegiatan yang sudah dipilih
        $selected = Schedule::where('tanggal', $tanggal)
            ->where('pegawai_id', $pegawai_id)
            ->pluck('kegiatan_id');

        return response()->json([
            'task_list' => $task_list,
            'selected' => $selected,
        ]);
    }

    // =======================
    // SAVE SCHEDULE
    // =======================
    public function saveSchedule(Request $req)
    {
        $req->validate([
            'tanggal'      => 'required|date',
            'pegawai_id'   => 'required',
            'kegiatan_ids' => 'array',
        ]);

        // hapus data lama untuk tanggal + pegawai ini
        Schedule::where('tanggal', $req->tanggal)
            ->where('pegawai_id', $req->pegawai_id)
            ->delete();

        // simpan ulang
        if ($req->kegiatan_ids) {
            foreach ($req->kegiatan_ids as $kid) {
                Schedule::create([
                    'tanggal'      => $req->tanggal,
                    'pegawai_id'   => $req->pegawai_id,
                    'kegiatan_id'  => $kid,
                ]);
            }
        }

        return response()->json(['success' => true]);
    }

    // =======================
    // FULLCALENDAR EVENTS
    // =======================
    public function getEvents($pegawai_id)
    {
        $data = Schedule::select('tanggal')
            ->where('pegawai_id', $pegawai_id)
            ->groupBy('tanggal')
            ->get()
            ->map(function ($item) {
                return [
                    'title' => 'Ada Kegiatan',
                    'start' => $item->tanggal,
                    'color' => '#ffc107', // warna kuning
                ];
            });

        return response()->json($data);
    }

    // =======================
    // DETAIL KEGIATAN PANEL KANAN
    // =======================
    public function getDayActivities(Request $req)
    {
        $list = Schedule::where('tanggal', $req->tanggal)
            ->where('pegawai_id', $req->pegawai_id)
            ->with('kegiatan')
            ->get();

        return response()->json($list);
    }


    public function index()
    {
        $pegawais = Pegawai::all();
        return view('admin.jadwalpegawai', compact('pegawais'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
