@extends('layouts.app_dashboard')

@push('title')
    {{ 'Ubah Profil' }}
@endpush

@section('content')
    <div class="container mt-3 mb-3">
        <div class="mb-3 d-flex align-items-center justify-content-between">
            <h3>Ubah Profil</h3>
            <div>
                <a href="{{ url('/dashboard') }}">Dashboard</a> / <span>Ubah Profil</span>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                @if (session('success') || session('error'))
                    <div class="alert alert-{{ session('success') ? 'success' : 'danger' }} alert-dismissible fade show" role="alert">
                        {{ session('success') ? session('success') : session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('profile-update', $profile->uuid) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="bi bi-person"></i></div>
                                    <input type="text" name="name" id="name" value="{{ old('name', $profile->name) }}" placeholder="Masukkan Nama" class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="bi bi-envelope"></i></div>
                                    <input type="email" name="email" id="email" value="{{ old('email', $profile->email) }}" placeholder="Masukkan Email" class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Peran</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="bi bi-person-badge"></i></div>
                                    <input type="text" name="" id="" value="{{ old('', $profile->role->role_name) }}" placeholder="" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="bi bi-lock"></i></div>
                                    <input type="password" id="password" name="password" placeholder="Masukkan Password" class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="bi bi-lock"></i></div>
                                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password" class="form-control @error('password_confirmation') is-invalid @enderror">
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
