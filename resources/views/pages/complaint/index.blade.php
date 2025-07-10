@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 'Aduan Warga' : 'Aduan'}}</h1>
    @if (isset(auth()->user()->resident))
    <a href="/complaint/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-plus fa-sm text-white-50"></i>Buat Aduan</a>
    @endif
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

@if (session('error'))
    <script>
        Swal.fire({
            title: "Terjadi Kesalahan!",
            text: "{{ session()->get('error')}}",
            icon: "error"
        });
    </script>
@endif

<div class="row">
    <div class="col">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Aduan</h6>
            </div>
            <div class="card-body">
                <table class="table table-responsive table-bordered table-hovered" style="font-size: 0.9rem">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            @if (auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN)
                                <th width="15%">Nama Warga</th>
                            @endif
                            <th width="15%">Judul</th>
                            <th width="25%">Isi Aduan</th>
                            <th width="10%">Status</th>
                            <th width="15%">Bukti (Foto)</th>
                            <th width="10%">Tanggal Laporan</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    @if (count($complaints) < 1)
                        <tbody>
                            <tr>
                                <td colspan="{{ auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 8 : 7 }}">
                                    <p class="pt-3 text-center">Data tidak ada</p>
                                </td>
                            </tr>
                        </tbody>
                    @else
                    <tbody>
                        @foreach ($complaints as $item)
                         <tr>
                            <td>{{ $loop->iteration + $complaints->firstItem() - 1 }}</td>
                            @if (auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN)
                                <td>{{$item->resident->nama}}</td>
                            @endif
                            <td>{{ $item->title }}</td>
                            <td style="white-space: pre-wrap; word-wrap: break-word;">{!! wordwrap($item->content,50,"<br>\n") !!}</td>
                            <td><span class="badge badge-{{$item->status_color}}">{{ $item->status_label }}</span></td>
                            <td>
                                @if (isset($item->photo_proof))
                                    @php
                                        $filePath =  'storage/' . $item->photo_proof;
                                    @endphp

                                    <a href="{{ $filePath}}" target="_blank" rel="noopener noreferrer">
                                        <img src="{{ $filePath}}" alt="Foto Bukti" style="max-width: 100px">
                                    </a>
                                @else
                                    Tidak ada
                                @endif
                            </td>
                            <td>{{ $item->report_date_label}}</td>
                            <td>
                                @if (auth()->user()->role_id == \App\Models\Role::ROLE_USER && isset(auth()->user()->resident) && $item->status == 'baru')
                                <div class="d-flex align-items-center" style="gap: 10px;">
                                    <a href="/complaint/{{ $item->id }}" class="d-inline block btn btn-sm btn-warning">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#konfirmasiDelete-{{ $item->id }}">
                                        <i class="fas fa-eraser"></i>
                                    </button>
                                </div>
                                @elseif(auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN)
                                <div>
                                    <form id="formChangeStatus-{{$item->id}}" action="complaint/update-status/{{$item->id}}" method="post">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group">
                                        <select name="status" id="status" class="form-control" style="min-width: 150px; font-size: 0.9rem" oninput="document.getElementById('formChangeStatus-{{$item->id}}').submit()">
                                            @foreach ([
                                                (object) [
                                                    'label' => 'Baru',
                                                    'value' => 'baru',
                                                ],
                                                (object) [
                                                    'label' => 'Sedang proses',
                                                    'value' => 'diproses',
                                                ],
                                                (object) [
                                                    'label' => 'Selesai',
                                                    'value' => 'selesai',
                                                ],
                                            ] as $status)
                                            <option value="{{$status->value}}" @selected($item->status == $status->value)>{{$status->label}}</option>
                                                
                                            @endforeach
                                        </select>
                                    </div>
                                </form>
                                </div>

                                @endif
                            </td>
                         </tr>   
                         @include('pages.complaint.konfirmasi-delete')
                        @endforeach
                        
                    </tbody>
                    @endif
                </table>   
            </div>
            @if($complaints->lastPage() > 1)
            <div class="card-footer">
                {{ $complaints->links('pagination::bootstrap-5')}}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection