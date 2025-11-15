            @extends('layouts.utama') {{-- Pakai layout utama --}}

            @section('title', isset($lokasi) ? 'Edit Location' : 'Add New Location')

            @section('content')
                        <div class="card">
                            <h5 class="card-title fw-semibold card-header">
                                {{ isset($lokasi) ? 'Edit Location' : 'Add New Location' }}
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
                                    action="{{ isset($lokasi) ? route('lokasi.update', $lokasi->id) : route('lokasi.store') }}" 
                                    method="POST" 
                                    enctype="multipart/form-data">
                                    @csrf
                                    @if (isset($lokasi))
                                        @method('PUT')
                                    @endif

                                    <div class="row">
                                        {{-- BUILDING --}}
                                        <div class="col-sm-6 mb-3">
                                            <label for="building" class="form-label">Building Name</label>
                                            <input type="text"
                                                class="rounded-pill form-control @error('building') is-invalid @enderror"
                                                id="building" name="building"
                                                value="{{ old('building', $lokasi->building ?? '') }}"
                                                required>
                                            @error('building') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>

                                        {{-- FLOOR --}}
                                        <div class="col-sm-6 mb-3">
                                            <label for="floor" class="form-label">Floor Name</label>
                                            <input type="text"
                                                class="rounded-pill form-control @error('floor') is-invalid @enderror"
                                                id="floor" name="floor"
                                                value="{{ old('floor', $lokasi->floor ?? '') }}"
                                                required>
                                            @error('floor') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>

                                        {{-- SSID --}}
                                        <div class="col-sm-6 mb-3">
                                            <label for="ssid" class="form-label">SSID / WIFI Name</label>
                                            <input type="text"
                                                class="rounded-pill form-control @error('ssid') is-invalid @enderror"
                                                id="ssid" name="ssid"
                                                value="{{ old('ssid', $lokasi->ssid ?? '') }}"
                                                required>
                                            @error('ssid') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>

                                        {{-- IP --}}
                                        <div class="col-sm-6 mb-3">
                                            <label for="ip_wifi" class="form-label">IP WIFI</label>
                                            <input type="ip_wifi"
                                                class="rounded-pill form-control @error('ip_wifi') is-invalid @enderror"
                                                id="ip_wifi" name="ip_wifi"
                                                value="{{ old('ip_wifi', $lokasi->ip_wifi ?? '') }}"
                                                required>
                                            @error('ip_wifi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select name="status" id="status" class="form-control rounded-pill @error('status') is-invalid @enderror">
                                                <option value="active"  {{ old('status', $lokasi->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ old('status', $lokasi->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                    {{-- BUTTONS --}}
                                    <div class="d-flex justify-content-end mt-3">
                                        <a href="{{ route('lokasi.index') }}" class="btn btn-warning me-2">Cancel</a>
                                        <button type="submit" class="btn btn-primary">
                                            {{ isset($lokasi) ? 'Update' : 'Add' }}
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
                    


                    // function previewImage(event) {
                    //     const preview = document.getElementById('preview');
                    //     const file = event.target.files[0];
                    //     if (file) {
                    //         const reader = new FileReader();
                    //         reader.onload = e => {
                    //             preview.src = e.target.result;
                    //             preview.classList.remove('d-none');
                    //         };
                    //         reader.readAsDataURL(file);
                    //     }
                    // }
                    setTimeout(() => {
                        const alert = document.getElementById('success-alert');
                        if (alert) {
                            const bsAlert = new bootstrap.Alert(alert);
                            bsAlert.close();
                        }
                    }, 3000);
                </script>
            @endsection