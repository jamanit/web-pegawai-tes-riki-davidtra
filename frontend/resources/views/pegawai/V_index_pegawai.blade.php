@extends('layouts.app_dashboard')

@push('title')
    {{ 'Daftar Pegawai' }}
@endpush

@section('content')
    <div class="container mt-3 mb-3">
        <div class="mb-3 d-flex align-items-center justify-content-between">
            <h3>Daftar Pegawai</h3>
            <div>
                <a href="{{ url('/dashboard') }}">Dashboard</a> / <span>Daftar Pegawai</span>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <a href="{{ route('pegawai.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus"></i> Tambah</a>
            </div>
            <div class="card-body">
                @if (session('success') || session('error'))
                    <div class="alert alert-{{ session('success') ? 'success' : 'danger' }} alert-dismissible fade show" role="alert">
                        {{ session('success') ? session('success') : session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <table class="table" id="dataTable">
                    <thead>
                        <tr>
                            <th>Aksi</th>
                            <th>NIP</th>
                            <th>Nama Pegawai</th>
                            <th>Tanggal Lahir</th>
                            <th>Tanggal Masuk</th>
                            <th>Jabatan</th>
                            <th>Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pegawai as $item)
                            <tr class="text-nowrap">
                                <td style="width: 1%">
                                    <a href="{{ route('pegawai.edit', $item->uuid) }}" class="btn btn-warning btn-sm" title="Ubah"><i class="bi bi-pencil"></i></a>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $item->uuid }}" title="Hapus"><i class="bi bi-trash"></i></button>
                                </td>
                                <td>{{ $item->nip }}</td>
                                <td>{{ $item->nama_pegawai }}</td>
                                <td>{{ $item->tanggal_lahir }}</td>
                                <td>{{ $item->tanggal_masuk }}</td>
                                <td>{{ $item->jabatan->nama_jabatan }}</td>
                                <td>{{ $item->created_at }}</td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal-{{ $item->uuid }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Peran</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menghapus data ini?</p>
                                            <p>Jika iya pilih "Hapus" untuk melanjutkan.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('pegawai.destroy', $item->uuid) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
