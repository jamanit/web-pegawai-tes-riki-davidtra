@extends('layouts.app_dashboard')

@push('title')
    {{ 'Ubah Peran' }}
@endpush

@section('content')
    <div class="container mt-3 mb-3">
        <div class="mb-3 d-flex align-items-center justify-content-between">
            <h3>Ubah Peran</h3>
            <div>
                <a href="{{ url('/dashboard') }}">Dashboard</a> / <a href="{{ url('/roles') }}">Daftar Peran</a> / <span>Ubah Peran</span>
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

                <form action="{{ route('roles.update', $role->uuid) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="role_name" class="form-label">Nama Peran</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="bi bi-person-badge"></i></div>
                                    <input type="text" name="role_name" id="role_name" value="{{ old('role_name', $role->role_name) }}" placeholder="Masukkan Nama Peran" class="form-control @error('role_name') is-invalid @enderror">
                                    @error('role_name')
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
