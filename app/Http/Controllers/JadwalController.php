<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Kegiatan;
use App\Models\Lokasi;

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
    public function save(Request $req)
    {
        $req->validate([
            'tanggal'     => 'required|date',
            'pegawai_id'  => 'required',
            'kegiatan_id' => 'required',
            'lokasi_id'   => 'required',
        ]);

        Schedule::create([
            'tanggal'     => $req->tanggal,
            'pegawai_id'  => $req->pegawai_id,
            'kegiatan_id' => $req->kegiatan_id,
            'lokasi_id'   => $req->lokasi_id,
            'created_by'  => auth()->id(),
            'created_ip'  => $req->ip(),
        ]);

        $schedules = Schedule::with(['kegiatan', 'lokasi'])
            ->where('tanggal', $req->tanggal)
            ->where('pegawai_id', $req->pegawai_id)
            ->get();

        return response()->json(['schedules' => $schedules]);
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
                    'title' => 'Tasks Available',
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


    public function modalData($tanggal, $pegawai_id)
    {
        return response()->json([
            'kegiatan' => Kegiatan::where('status', 1)->get(),
            'lokasi'   => Lokasi::where('status', 1)->get(),
            'schedules' => Schedule::with(['kegiatan', 'lokasi'])
                ->where('tanggal', $tanggal)
                ->where('pegawai_id', $pegawai_id)
                ->get(),
        ]);
    }



    public function index()
    {
        $pegawais = Pegawai::where('status', 'active')->get();
        $lokasis = Lokasi::where('status', 'active')->get();
        $kegiatans = Kegiatan::where('status', 'active')->get();

        return view('admin.jadwalpegawai', compact('pegawais', 'kegiatans', 'lokasis'));
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
    public function store(Request $r)
    {
        Schedule::create([
            'tanggal'     => $r->tanggal,
            'pegawai_id'  => $r->pegawai_id,
            'kegiatan_id' => $r->kegiatan_id,
            'lokasi_id'   => $r->lokasi_id,
        ]);

        $schedules = Schedule::with(['kegiatan', 'lokasi'])
            ->where('tanggal', $r->tanggal)
            ->where('pegawai_id', $r->pegawai_id)
            ->get();

        return response()->json(['schedules' => $schedules]);
    }

    public function delete($id, Request $r)
    {
        $schedule = Schedule::findOrFail($id);
        $tanggal = $schedule->tanggal;
        $pegawai = $schedule->pegawai_id;

        $schedule->delete();

        $schedules = Schedule::with(['kegiatan', 'lokasi'])
            ->where('tanggal', $tanggal)
            ->where('pegawai_id', $pegawai)
            ->get();

        return response()->json(['schedules' => $schedules]);
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
