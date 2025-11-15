            @extends('layouts.utama') {{-- Pakai layout utama --}}

            @section('title', isset($user) ? 'Edit Employee' : 'Add New Employee' )

            @section('content')
                        <div class="card">
                            <h5 class="card-title fw-semibold card-header">
                                {{ isset($user) ? 'Edit User' : 'Add New User' }}
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
                                    action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" 
                                    method="POST" 
                                    enctype="multipart/form-data">
                                    @csrf
                                    @if (isset($user))
                                        @method('PUT')
                                    @endif

                                    <div class="row">
                                        {{-- NAME --}}
                                        <div class="col-sm-6 mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text"
                                                class="rounded-pill form-control @error('name') is-invalid @enderror"
                                                id="name" name="name"
                                                value="{{ old('name', $user->name ?? '') }}"
                                                required>
                                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>

                                        {{-- NIK --}}
                                        <div class="col-sm-6 mb-3">
                                            <label for="nik" class="form-label">ID Card</label>
                                            <input type="text"
                                                class="rounded-pill form-control @error('nik') is-invalid @enderror"
                                                id="nik" name="nik"
                                                value="{{ old('nik', $user->nik ?? '') }}"
                                                required>
                                            @error('nik') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>

                                        {{-- EMPLOYEE ID --}}
                                        <div class="col-sm-6 mb-3">
                                            <label for="employee_id" class="form-label">Employee ID</label>
                                            <input type="text"
                                                class="rounded-pill form-control @error('employee_id') is-invalid @enderror"
                                                id="employee_id" name="employee_id"
                                                value="{{ old('employee_id', $user->employee_id ?? '') }}"
                                                required>
                                            @error('employee_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>

                                        {{-- EMAIL --}}
                                        <div class="col-sm-6 mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email"
                                                class="rounded-pill form-control @error('email') is-invalid @enderror"
                                                id="email" name="email"
                                                value="{{ old('email', $user->email ?? '') }}"
                                                required>
                                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>

                                        {{-- WHATSAPP --}}
                                        <div class="col-sm-6 mb-3">
                                            <label for="nomor_wa" class="form-label">Phone Number / WhatsApp Number</label>
                                            <input type="tel"
                                                class="rounded-pill form-control @error('nomor_wa') is-invalid @enderror"
                                                id="nomor_wa" name="nomor_wa"
                                                value="{{ old('nomor_wa', $user->nomor_wa ?? '') }}"
                                                required>
                                            @error('nomor_wa') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>

                                        {{-- LEVEL --}}
                                        <div class="col-sm-6 mb-3">
                                            <label for="level" class="form-label">User Role</label>
                                            <select name="level" class="form-control rounded-pill @error('level') is-invalid @enderror">
                                                <option value="administrator" {{ old('level', $user->level ?? '') == 'administrator' ? 'selected' : '' }}>Administrator</option>
                                                <option value="staff" {{ old('level', $user->level ?? '') == 'staff' ? 'selected' : '' }}>Staf</option>
                                            </select>
                                            @error('level') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>

                                        {{-- STATUS --}}
                                        <div class="col-sm-6 mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select name="status" id="status" class="form-control rounded-pill @error('status') is-invalid @enderror">
                                                <option value="active"  {{ old('status', $user->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ old('status', $user->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>

                                        {{-- ALASAN INACTIVE --}}
                                        <div class="col-sm-6 mb-3" id="inactive_reason_container" style="display: none;">
                                            <label for="inactive_reason" class="form-label">Inactive Reason</label>
                                            <select name="inactive_reason" id="inactive_reason" class="form-control rounded-pill @error('inactive_reason') is-invalid @enderror">
                                                <option value="">-- Select Reason --</option>
                                                <option value="resigned" {{ old('inactive_reason', $user->inactive_reason ?? '') == 'resigned' ? 'selected' : '' }}>Resigned</option>
                                                <option value="retired" {{ old('inactive_reason', $user->inactive_reason ?? '') == 'retired' ? 'selected' : '' }}>Retired</option>
                                                <option value="deceased" {{ old('inactive_reason', $user->inactive_reason ?? '') == 'deceased' ? 'selected' : '' }}>Deceased</option>
                                                <option value="terminated" {{ old('inactive_reason', $user->inactive_reason ?? '') == 'terminated' ? 'selected' : '' }}>Terminated</option>
                                                <option value="contract ended" {{ old('inactive_reason', $user->inactive_reason ?? '') == 'contract ended' ? 'selected' : '' }}>Contract Ended</option>
                                                <option value="suspended" {{ old('inactive_reason', $user->inactive_reason ?? '') == 'suspended' ? 'selected' : '' }}>Suspended</option>
                                                <option value="unpaid leave" {{ old('inactive_reason', $user->inactive_reason ?? '') == 'unpaid leave' ? 'selected' : '' }}>Unpaid Leave</option>
                                                <option value="laid off" {{ old('inactive_reason', $user->inactive_reason ?? '') == 'laid off' ? 'selected' : '' }}>Laid Off</option>
                                                <option value="absconded" {{ old('inactive_reason', $user->inactive_reason ?? '') == 'absconded' ? 'selected' : '' }}>Absconded</option>


                                            </select>
                                            @error('inactive_reason') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>


                                        {{-- PASSWORD --}}
                                        <div class="col-sm-6 mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password"
                                                class="rounded-pill form-control @error('password') is-invalid @enderror"
                                                id="password" name="password"
                                                {{ !isset($user) ? 'required' : '' }}
                                                placeholder="{{ isset($user) ? 'Kosongkan jika tidak diubah' : 'Minimal 8 karakter' }}">
                                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>

                                        {{-- CONFIRM PASSWORD --}}
                                        <div class="col-sm-6 mb-3">
                                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                                            <input type="password" class="rounded-pill form-control" id="password_confirmation" name="password_confirmation">
                                        </div>

                                        {{-- FOTO --}}
                                        <div class="col-sm-6 mb-3">
                                            <label for="foto" class="form-label">Employee Photo</label>
                                            <input type="file" class="rounded-pill form-control @error('foto') is-invalid @enderror" name="foto" accept="image/*" onchange="previewImage(event)">
                                            @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                            <div class="mt-3 text-center">
                                                @if (isset($user->foto))
                                                    <img id="preview" src="{{ asset('storage/' . $user->foto) }}" alt="Foto" class="img-thumbnail" style="max-width:200px;border-radius:10px;">
                                                @else
                                                    <img id="preview" src="#" class="img-thumbnail d-none" style="max-width:200px;border-radius:10px;">
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    {{-- BUTTONS --}}
                                    <div class="d-flex justify-content-end mt-3">
                                        <a href="{{ route('users.index') }}" class="btn btn-warning me-2">Cancel</a>
                                        <button type="submit" class="btn btn-primary">
                                            {{ isset($user) ? 'Update' : 'Add' }}
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

                    // Show/hide inactive reason field
                    function toggleInactiveReason() {
                        const status = document.getElementById('status').value;
                        const container = document.getElementById('inactive_reason_container');

                        if (status === 'inactive') {
                            container.style.display = 'block';
                        } else {
                            container.style.display = 'none';
                            document.getElementById('inactive_reason').value = '';
                        }
                    }

                    // Run on page load
                    toggleInactiveReason();

                    // Run every time status changes
                    document.getElementById('status').addEventListener('change', toggleInactiveReason);

                </script>
            @endsection