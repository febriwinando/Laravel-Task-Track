            @extends('layouts.utama') {{-- Pakai layout utama --}}

            @section('title', 'Dashboad Aduan')

            @section('content')
                        <div class="card">
                            <h5 class="card-title fw-semibold card-header">
                               Add New Employee
                            </h5>
                            <div class="card-body">
                                {{-- ALERT SUKSES --}}
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                <form action="{{ route('pegawai.store') }}" method="POST" enctype="multipart/form-data">                                    @csrf
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-sm-6 mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input
                                                    type="text"
                                                    class="rounded-pill form-control @error('name') is-invalid @enderror"
                                                    id="name"
                                                    name="name"
                                                    value=""
                                                    placeholder="employee name"
                                                    required
                                                >
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6 mb-3">
                                                    <label for="nik" class="form-label">ID Card</label>
                                                    <input
                                                        type="text"
                                                        class="rounded-pill form-control @error('nik') is-invalid @enderror"
                                                        id="nik"
                                                        name="nik"
                                                        value=""
                                                        placeholder="example: 1212010902940001"
                                                        required
                                                    >
                                                    @error('nik')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                            <div class="col-sm-6 mb-3">
                                                    <label for="employee_id" class="form-label">Employee ID</label>
                                                    <input
                                                        type="text"
                                                        class="rounded-pill form-control @error('employee_id') is-invalid @enderror"
                                                        id="employee_id"
                                                        name="employee_id"
                                                        value=""
                                                        placeholder="Employee Identification Number"
                                                        required
                                                    >
                                                    @error('employee_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                            <div class="col-sm-6 mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input
                                                        type="email"
                                                        class="rounded-pill form-control @error('email') is-invalid @enderror"
                                                        id="email"
                                                        name="email"
                                                        value=""
                                                        placeholder="example: kartika@mail.com"
                                                        required
                                                    >
                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                            <div class="col-sm-6 mb-3">
                                                    <label for="nomor_wa" class="form-label">Phone Number/Whatsapp Number</label>
                                                    <input
                                                        type="tel"
                                                        class="rounded-pill form-control @error('nomor_wa') is-invalid @enderror"
                                                        id="nomor_wa"
                                                        name="nomor_wa"
                                                        value=""
                                                        placeholder="example: 6285762183348"
                                                        required
                                                    >
                                                    @error('nomor_wa')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                            <div class="col-sm-6 mb-3">
                                                <label for="level" class="form-label">User Role</label>
                                                <select name="level" class="form-control rounded-pill @error('level') is-invalid @enderror">
                                                    <option value="officer">Officer</option>
                                                    <option value="verifier" >Verifier</option>
                                                </select>
                                                @error('level')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6 mb-3">
                                                <label for="password" class="form-label @error('password') is-invalid @enderror">Password</label>
                                                <input
                                                    type="password"
                                                    class="rounded-pill form-control"
                                                    id="password"
                                                    name="password"
                                                    placeholder="password must be at least 8 characters"

                                                >
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6 mb-3">
                                                <label for="password_confirmation @error('password_confirmation') is-invalid @enderror" class="form-label">Confirm Password</label>
                                                <input
                                                    type="password"
                                                    class="rounded-pill form-control"
                                                    id="password_confirmation"
                                                    name="password_confirmation"
                                                    placeholder="re-enter password"

                                                >
                                                @error('password_confirmation')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6 mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select name="status" class="form-control rounded-pill @error('status') is-invalid @enderror">
                                                    <option value="active">Active</option>
                                                    <option value="inactive" >Inactive</option>
                                                </select>
                                                @error('status')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="foto" class="form-label">Employee Photo</label>
                                                        <input
                                                            type="file"
                                                            class="rounded-pill form-control @error('foto') is-invalid @enderror"
                                                            id="foto"
                                                            name="foto"
                                                            accept="image/*"
                                                            onchange="previewImage(event)"
                                                        >
                                                        @error('foto')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror

                                                        <!-- Preview gambar -->
                                                        <div class="mt-3 text-center">
                                                            <img id="preview" src="#" alt="Preview" class="img-thumbnail d-none" style="max-width: 200px; border-radius: 10px;">
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    

                                    {{-- TOMBOL --}}
                                    <div class="d-flex justify-content-end">
                                        <a href="" class="btn btn-warning me-2">Cancel</a>
                                        <button type="submit" class="btn btn-primary">
                                            Add
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