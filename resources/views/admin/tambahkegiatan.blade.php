            @extends('layouts.utama') {{-- Pakai layout utama --}}

            @section('title', 'Dashboad Aduan')

            @section('content')
                        <div class="card">
                            <h5 class="card-title fw-semibold card-header">
                                {{ isset($kegiatan) ? 'Edit Task' : 'Add New Task' }}
                            </h5>
                            <div class="card-body">
                                {{-- ALERT SUKSES --}}
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                <form 
                                    action="{{ isset($kegiatan) ? route('kegiatan.update', $kegiatan->id) : route('kegiatan.store') }}" 
                                    method="POST" 
                                    enctype="multipart/form-data">
                                    @csrf
                                    @if (isset($kegiatan))
                                        @method('PUT')
                                    @endif

                                    <div class="row">
                                        {{-- BUILDING --}}
                                        <div class="col-sm-12 mb-3">
                                            <label for="task" class="form-label">Task</label>
                                            <input type="text"
                                                class="rounded-pill form-control @error('task') is-invalid @enderror"
                                                id="task" name="task"
                                                value="{{ old('task', $kegiatan->task ?? '') }}"
                                                required>
                                            @error('task') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="keterangan" class="form-label">Information of Task</label>
                                            <textarea name="keterangan" id="keterangan" 
                                                class="form-control @error('keterangan') is-invalid @enderror" 
                                                rows="3">{{ old('keterangan', $kegiatan->keterangan ?? '') }}</textarea>

                                            @error('keterangan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-sm-12 mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select name="status" id="status" class="form-control rounded-pill @error('status') is-invalid @enderror">
                                                <option value="active"  {{ old('status', $kegiatan->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ old('status', $kegiatan->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>

                                    {{-- BUTTONS --}}
                                    <div class="d-flex justify-content-end mt-3">
                                        <a href="{{ route('kegiatan.index') }}" class="btn btn-warning me-2">Cancel</a>
                                        <button type="submit" class="btn btn-primary">
                                            {{ isset($kegiatan) ? 'Update' : 'Add' }}
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>

                {{-- Script preview --}}
                <script>
                    function previewImage(event) {
                        const preview = document.getElementById('preview');
                        const file = event.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                preview.src = e.target.result;
                                preview.classList.remove('d-none');
                            }
                            reader.readAsDataURL(file);
                        } else {
                            preview.src = '#';
                            preview.classList.add('d-none');
                        }
                    }
                    

                    setTimeout(() => {
                        const alert = document.getElementById('success-alert');
                        if (alert) {
                            const bsAlert = new bootstrap.Alert(alert);
                            bsAlert.close();
                        }
                    }, 3000);
                </script>
            @endsection