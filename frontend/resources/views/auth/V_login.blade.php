@extends('layouts.app_auth')

@push('title')
    {{ 'Masuk' }}
@endpush

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex gap-1 align-items-center">
                            <h5 class="m-0 fw-bold">{{ env('APP_NAME', 'App Name') }}</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="mb-3 text-center">Masuk</h3>

                        @if (session('success') || session('error'))
                            <div class="alert alert-{{ session('success') ? 'success' : 'danger' }} alert-dismissible fade show" role="alert">
                                {{ session('success') ? session('success') : session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login-process') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="bi bi-envelope"></i></div>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan Email" class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
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
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Ingat Saya
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Masuk</button>
                        </form>

                        <hr>
                        <div class="text-center">
                            Tidak punya akun? <a href="{{ url('register') }}">Daftar</a>
                        </div>
                    </div>
                    <div class="card-footer">
                        <p class="text-end">Created By {{ env('APP_CREATED_BY', 'App Created By') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
