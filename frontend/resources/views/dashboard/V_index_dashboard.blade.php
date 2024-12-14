@extends('layouts.app_dashboard')

@push('title')
    {{ 'Dashboard' }}
@endpush

@section('content')
    <div class="container mt-3 mb-3">
        <div class="mb-3 d-flex align-items-center justify-content-between">
            <h3>Dashboard</h3>
        </div>

        <div class="alert alert-info alert-dismissible fade show" role="alert">
            Created By {{ env('APP_CREATED_BY', 'App Created By') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <div class="row">
            <div class="col-md-4">
                <a href="{{ url('roles') }}" style="text-decoration: none;">
                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="bi bi-person-badge" style="font-size: 3rem;"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Peran</h6>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ url('users') }}" style="text-decoration: none;">
                    <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="bi bi-people" style="font-size: 3rem;"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Pengguna</h6>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>
@endsection

@push('styles')
    <style>
        a:hover .card {
            transform: scale(1.05);
            filter: brightness(0.85);
            transition: transform 0.3s ease-in-out, filter 0.3s ease-in-out;
        }
    </style>
@endpush

@push('scripts')
@endpush
