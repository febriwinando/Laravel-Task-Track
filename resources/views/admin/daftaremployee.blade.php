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
            <h3>Daftar Pegawai</h3>
            <a href="{{ route('pegawai.create') }}" class="btn btn-primary">+ Tambah Pegawai</a>
        </div>
        <div class="card-body">
            <div class="table-responsive rounded">
                <table class="table table-striped align-middle table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>ID Pegawai</th>
                            <th>Email</th>
                            <th>Nomor WA</th>
                            <th>Level</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pegawais as $pegawai)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pegawai->name }}</td>
                                <td>{{ $pegawai->nik }}</td>
                                <td>{{ $pegawai->employee_id }}</td>
                                <td>{{ $pegawai->email }}</td>
                                <td>{{ $pegawai->nomor_wa }}</td>
                                <td>{{ $pegawai->level }}</td>
                                <td>
                                    @if ($pegawai->foto)
                                        <img src="{{ asset('storage/' . $pegawai->foto) }}" alt="Foto" width="60" height="60" class="rounded-circle object-fit-cover">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('pegawai.destroy', $pegawai->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin hapus?')">
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
