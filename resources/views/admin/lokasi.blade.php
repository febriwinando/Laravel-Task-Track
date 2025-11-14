@extends('layouts.utama')

@section('content')
<div class="container mt-4">


    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-title fw-semibold card-header d-flex justify-content-between align-items-center mb-3">
            <h3>List Locations</h3>
            <a href="{{ route('lokasi.create') }}" class="btn btn-primary">+ Add New Location</a>
        </div>
        <div class="card-body">
            <div class="table-responsive rounded">
                <table class="table table-striped align-middle table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Building</th>
                            <th>Floor</th>
                            <th>SSID</th>
                            <th>IP WiFi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($lokasis as $lokasi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $lokasi->building }}</td>
                                <td>{{ $lokasi->floor }}</td>
                                <td>{{ $lokasi->ssid }}</td>
                                <td>{{ $lokasi->ip_wifi }}</td>
                                <td>
                                    <a href="{{ route('lokasi.edit', $lokasi->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('lokasi.destroy', $lokasi->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted">Belum ada data pegawai.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
