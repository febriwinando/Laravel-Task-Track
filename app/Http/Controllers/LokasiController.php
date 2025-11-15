<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lokasi;


class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lokasis = Lokasi::all();
        return view('admin.lokasi', compact('lokasis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tambahlokasi');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'building' => 'required|string|max:255',
            'floor' => 'required|string|max:255',
            'ssid' => 'required|string|max:255',
            'ip_wifi' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $validated['created_by']=auth()->id();
        $validated['created_ip']=$request->ip();

        Lokasi::create($validated);

        return redirect()->route('lokasi.index')
            ->with('success', 'Location added successfully!');
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
    public function edit(Lokasi $lokasi)
    {
        return view('admin.tambahlokasi', compact('lokasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'building' => 'required|string|max:255',
            'floor' => 'required|string|max:255',
            'ssid' => 'required|string|max:255',
            'ip_wifi' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $validated['updated_by']=auth()->id();
        $validated['updated_ip']=$request->ip();

        $lokasi = Lokasi::findOrFail($id);
        $lokasi->update($validated);

        return redirect()->route('lokasi.index')
            ->with('success', 'Location updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lokasi $lokasi)
    {
        $lokasi->delete();

        return redirect()->route('lokasi.index')->with('success', 'Location deleted successfully!');
    }
}
