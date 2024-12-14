@extends('layouts.app_dashboard')

@push('title')
    {{ 'Ubah Pegawai' }}
@endpush

@section('content')
    <div class="container mt-3 mb-3">
        <div class="mb-3 d-flex align-items-center justify-content-between">
            <h3>Ubah Pegawai</h3>
            <div>
                <a href="{{ url('/dashboard') }}">Dashboard</a> / <a href="{{ url('/roles') }}">Daftar Pegawai</a> / <span>Ubah Pegawai</span>
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
                                <label for="nama_pegawai" class="form-label">Nama Peran</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="bi bi-person-badge"></i></div>
                                    <input type="text" name="nama_pegawai" id="nama_pegawai" value="{{ old('nama_pegawai', $role->nama_pegawai) }}" placeholder="Masukkan Nama Peran" class="form-control @error('nama_pegawai') is-invalid @enderror">
                                    @error('nama_pegawai')
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
