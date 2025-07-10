@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-key mr-2"></i>Ubah Password Anda
        </h1>
    </div>

    <!-- Alert Notifications -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session()->get('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            {{ session()->get('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-white">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-user-shield mr-2"></i>Form Ubah Password
                    </h6>
                </div>
                <form action="/ubah-pw/{{ auth()->user()->id }}" method="post">
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <div class="form-group mb-4">
                            <label for="old_password" class="font-weight-bold text-gray-700">
                                <i class="fas fa-lock mr-2"></i>Password Lama
                            </label>
                            <div class="input-group">
                                <input type="password" name="old_password" id="old_password" 
                                       class="form-control @error('old_password') is-invalid @enderror"
                                       placeholder="Masukkan password lama Anda">
                                <div class="input-group-append">
                                    <span class="input-group-text toggle-password" data-target="old_password">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                                @error('old_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="new_password" class="font-weight-bold text-gray-700">
                                <i class="fas fa-key mr-2"></i>Password Baru
                            </label>
                            <div class="input-group">
                                <input type="password" name="new_password" id="new_password" 
                                       class="form-control @error('new_password') is-invalid @enderror"
                                       placeholder="Masukkan password baru Anda">
                                <div class="input-group-append">
                                    <span class="input-group-text toggle-password" data-target="new_password">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                                @error('new_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <small class="form-text text-muted">
                                Password harus minimal 8 karakter dan mengandung kombinasi huruf dan angka.
                            </small>
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-between">
                            <a href="/dasbor" class="btn btn-outline-secondary px-4">
                                <i class="fas fa-times mr-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save mr-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 0.5rem;
        border: none;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
    }
    
    .card-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .form-control {
        height: calc(1.5em + 1rem + 2px);
        border-radius: 0.35rem;
    }
    
    .input-group-text {
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .input-group-text:hover {
        background-color: #e9ecef;
    }
    
    .toggle-password.active .fa-eye {
        display: none;
    }
    
    .toggle-password.active .fa-eye-slash {
        display: inline-block;
    }
    
    .toggle-password .fa-eye-slash {
        display: none;
    }
    
    .btn {
        border-radius: 0.35rem;
        font-weight: 600;
    }
    
    @media (max-width: 576px) {
        .d-flex.justify-content-between {
            flex-direction: column;
            gap: 10px;
        }
        
        .btn {
            width: 100%;
        }
    }
</style>

<script>
    $(document).ready(function() {
        // Toggle password visibility
        $('.toggle-password').click(function() {
            $(this).toggleClass('active');
            var target = $(this).data('target');
            var input = $('#' + target);
            
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
            } else {
                input.attr('type', 'password');
            }
        });
    });
</script>
@endsection