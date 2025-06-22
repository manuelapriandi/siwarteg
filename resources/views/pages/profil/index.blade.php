@extends('layouts.app')

@section('content')
 <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Profil Anda</h1>
        </div>    
        {{-- @if ($errors->any())
            @dd($errors->all())
        @endif --}}
       @if (session('success'))
            <script>
                Swal.fire({
                    title: "Berhasil!",
                    text: "{{ session()->get('success')}}",
                    icon: "success"
                });
            </script>
        @endif

        <div class="row">
            <div class="col">
                <form action="/profil/{{ auth()->user()->id }}" method="post">
                    @csrf
                    @method('POST')
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old ('name', auth()->user()->name) }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old ('email', auth()->user()->email) }}" readonly>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-end" style="gap: 10px">
                                <a href="/dasbor" class="btn btn-outline-secondary">
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-warning">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

@endsection