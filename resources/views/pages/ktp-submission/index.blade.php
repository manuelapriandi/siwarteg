@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 'Daftar Pengajuan Berkas' : 'Pengajuan Berkas Saya' }}</h1>
    @if (auth()->user()->role_id == \App\Models\Role::ROLE_USER && isset(auth()->user()->resident))
    <a href="/ktp-submission/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-plus fa-sm text-white-50"></i> Buat Pengajuan Berkas</a>
    @endif
</div>

@if (session('success'))
<script>
    Swal.fire({
        title: "Berhasil!",
        text: "{{ session()->get('success') }}",
        icon: "success"
    });
</script>
@endif
@if (session('error'))
<script>
    Swal.fire({
        title: "Terjadi Kesalahan!",
        text: "{{ session()->get('error') }}",
        icon: "error"
    });
</script>
@endif

<div class="row">
    <div class="col">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Pengajuan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hovered" style="font-size: 0.9rem">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                @if (auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN)
                                <th width="15%">Nama Warga</th>
                                @endif
                                <th width="15%">Jenis Pengajuan</th>
                                <th width="20%">Catatan</th>
                                <th width="15%">Status</th>
                                <th width="15%">Dokumen Syarat</th>
                                <th width="10%">Tanggal Pengajuan</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        @if (count($ktpSubmissions) < 1)
                        <tbody>
                            <tr>
                                <td colspan="{{ auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 8 : 7 }}">
                                    <p class="pt-3 text-center">Data tidak ada</p>
                                </td>
                            </tr>
                        </tbody>
                        @else
                        <tbody>
                            @foreach ($ktpSubmissions as $item)
                            <tr>
                                <td>{{ $loop->iteration + $ktpSubmissions->firstItem() - 1 }}</td>
                                @if (auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN)
                                <td>{{ $item->resident->nama ?? 'N/A' }}</td>
                                @endif
                                <td>Surat Pengantar {{ $item->submission_type }}</td>
                                <td style="white-space: pre-wrap; word-wrap: break-word;">{!! wordwrap($item->notes ?? 'Tidak ada catatan', 50, "<br>\n") !!}</td>
                                <td><span class="badge badge-{{ $item->status_color }}">{{ $item->status_label }}</span></td>
                                <td>
                                    @if (isset($item->document_proof))
                                        @php
                                        $filePath =  'storage/' . $item->document_proof;
                                        @endphp

                                    <a href="{{ $filePath}}" target="_blank" rel="noopener noreferrer">
                                        <img src="{{ $filePath}}" alt="Dokumen Syarat" style="max-width: 100px">
                                    </a>
                                    @else
                                        Tidak ada
                                    @endif
                                </td>
                                <td>{{ $item->submission_date_label }}</td>
                                <td>
                                    @if (auth()->user()->role_id == \App\Models\Role::ROLE_USER && isset(auth()->user()->resident) && $item->status == 'baru')
                                    <div class="d-flex align-items-center" style="gap: 10px;">
                                        <a href="/ktp-submission/{{ $item->id }}/edit" class="d-inline block btn btn-sm btn-warning">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#konfirmasiDelete-{{ $item->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    @elseif(auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN)
                                    <div>
                                        <form id="formChangeStatus-{{$item->id}}" action="/ktp-submission/update-status/{{$item->id}}" method="post">
                                            @csrf
                                            @method('POST')
                                            <div class="form-group mb-2">
                                                <select name="status" id="status" class="form-control form-control-sm" style="min-width: 150px; font-size: 0.9rem" onchange="this.form.submit()">
                                                    @foreach ([
                                                        (object) ['label' => 'Baru', 'value' => 'baru'],
                                                        (object) ['label' => 'Sedang Proses', 'value' => 'diproses'],
                                                        (object) ['label' => 'Selesai', 'value' => 'selesai'],
                                                        (object) ['label' => 'Ditolak', 'value' => 'ditolak'],
                                                    ] as $statusOption)
                                                        <option value="{{ $statusOption->value }}" @selected($item->status == $statusOption->value)>{{ $statusOption->label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <textarea name="admin_notes" class="form-control form-control-sm" placeholder="Catatan Admin (opsional)" rows="2">{{ $item->admin_notes }}</textarea>
                                                <button type="submit" class="btn btn-primary btn-sm mt-2">Update Status</button>
                                            </div>
                                        </form>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @include('pages.ktp-submission.konfirmasi-delete')
                            @endforeach
                        </tbody>
                        @endif
                    </table>
                </div>
            </div>
            @if($ktpSubmissions->lastPage() > 1)
            <div class="card-footer">
                {{ $ktpSubmissions->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection