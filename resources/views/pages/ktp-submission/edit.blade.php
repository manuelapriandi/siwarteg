@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ubah Pengajuan Berkas</h1>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row">
    <div class="col">
        <form action="/ktp-submission/{{ $ktpSubmission->id }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="submission_type">Jenis Pengajuan Berkas</label>
                        <select name="submission_type" id="submission_type" class="form-control @error('submission_type') is-invalid @enderror">
                            <option value="">-- Pilih Jenis Pengajuan --</option>
                            @foreach ($submissionTypes as $value => $label)
                                <option value="{{ $value }}" {{ old('submission_type', $ktpSubmission->submission_type) == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('submission_type')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="notes">Catatan/Keterangan Tambahan (Opsional)</label>
                        <textarea name="notes" id="notes" cols="30" rows="5" class="form-control @error('notes') is-invalid @enderror">{{ old('notes', $ktpSubmission->notes) }}</textarea>
                        @error('notes')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="document_proof">Dokumen Bukti (Misal: Scan Kartu Keluarga, Akta Lahir, dll.)</label>
                        <input type="file" name="document_proof" id="document_proof" class="form-control @error('document_proof') is-invalid @enderror">
                        <small class="form-text text-muted">Format yang diizinkan: PDF, JPG, JPEG, PNG. Maksimal 5MB. Biarkan kosong jika tidak ingin mengubah dokumen.</small>
                        @error('document_proof')
                        <span class="invalid-feedback">
                            Tolong unggah file yang sesuai.
                        </span>
                        @enderror

                        
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end" style="gap: 10px">
                        <a href="/ktp-submission" class="btn btn-outline-secondary">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection