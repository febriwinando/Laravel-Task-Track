@extends('layouts.utama')
@section('title', 'List Tasks')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-title fw-semibold card-header d-flex justify-content-between align-items-center mb-3">
            <h3>List Tasks</h3>
            <a href="{{ route('kegiatan.create') }}" class="btn btn-primary">+ Add New Task</a>
        </div>
        <div class="card-body">
            <div class="table-responsive rounded">
                <table class="table table-striped align-middle table-hover table-striped-columns table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Task</th>
                            <th>Information</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @forelse ($kegiatans as $kegiatan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kegiatan->task }}</td>
                                <td>{{ $kegiatan->keterangan }}</td>
                                <td>{{ $kegiatan->status }}</td>
                                <td>
                                    <a href="{{ route('kegiatan.edit', $kegiatan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('kegiatan.destroy', $kegiatan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this?')">
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
@endsection
