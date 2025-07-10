@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Profil Anda</h1>
    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                title: "Berhasil!",
                text: "{{ session()->get('success')}}",
                icon: "success"
            });
        </script>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">
            {{-- IMPORTANT: Added enctype for file uploads and changed method to POST --}}
            <form action="/profil/{{ auth()->user()->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST') {{-- This will be processed as PUT/PATCH by Laravel based on your route definition --}}
                <div class="card border-0 shadow-lg mb-4">
                    <div class="card-header bg-primary text-white py-3 rounded-top">
                        <h5 class="m-0 font-weight-bold">Pengaturan Profil</h5>
                    </div>
                    <div class="card-body p-4">
                        {{-- Profile Picture Section --}}
                        <div class="form-group mb-4 text-center">
                            <label for="profile_picture" class="form-label font-weight-bold text-dark d-block mb-3">Ubah Foto Profil</label>
                            <div class="profile-picture-container mb-3">
                                {{-- Display current profile picture or a placeholder --}}
                                <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('template/img/undraw_profile.svg') }}"
                                     alt="Foto Profil"
                                     class="img-fluid rounded-circle"
                                     style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #ddd;">
                            </div>
                            <div class="custom-file" style="max-width: 300px; margin: auto;">
                                <input type="file" class="custom-file-input @error('profile_picture') is-invalid @enderror" id="profile_picture" name="profile_picture" accept="image/*">
                                <label class="custom-file-label" for="profile_picture">Pilih Foto Baru</label>
                                @error('profile_picture')
                                    <div class="invalid-feedback d-block"> {{-- Use d-block to ensure visibility for custom-file-input --}}
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-text text-muted mt-2">Ukuran maksimal file: 2MB. Format: JPG, PNG.</small>
                            </div>
                        </div>

                        <hr class="my-4"> {{-- Separator for visual clarity --}}

                        {{-- Nama Lengkap Section --}}
                        <div class="form-group mb-4">
                            <label for="name" class="form-label font-weight-bold text-dark mb-1">Nama Lengkap</label>
                            <div class="input-group input-group-lg">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old ('name', auth()->user()->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Email Section --}}
                        <div class="form-group mb-4">
                            <label for="email" class="form-label font-weight-bold text-dark mb-1">Email</label>
                            <div class="input-group input-group-lg">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old ('email', auth()->user()->email) }}" readonly>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light border-0 pt-3 pb-4 d-flex justify-content-end rounded-bottom">
                        <div class="d-flex" style="gap: 10px">
                            <a href="/dasbor" class="btn btn-outline-secondary btn-lg">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-warning btn-lg">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Script to display selected file name in custom file input
    document.getElementById('profile_picture').addEventListener('change', function(e) {
        var fileName = e.target.files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>
@endpush