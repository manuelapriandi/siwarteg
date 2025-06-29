 @extends('layouts.app')

 @section('content')
 <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Warga</h1>
            <a href="/resident/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>
        </div>

        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-body">
                        <table class="table table-responsive table-bordered table-hovered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tempat, Tanggal Lahir</th>
                                    <th>Alamat</th>
                                    <th>Agama</th>
                                    <th>Status Perkawinan</th>
                                    <th>Pekerjaan</th>
                                    <th>Telepon</th>
                                    <th>Status Warga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            @if (count($residents) < 1)
                                <tbody>
                                    <tr>
                                        <td colspan="11">
                                            <p class="pt-3 text-center">Data tidak ada</p>
                                        </td>
                                    </tr>
                                </tbody>
                            @else
                            <tbody>
                                @foreach ($residents as $item)
                                 <tr>
                                    <td>{{ $loop->iteration + $residents->firstItem() - 1 }}</td>
                                    <td>{{ $item->nik }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->jk }}</td>
                                    <td>{{ $item->tmpt_lahir }}, {{ $item->tgl_lahir }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->agama }}</td>
                                    <td>{{ $item->status_kwn }}</td>
                                    <td>{{ $item->pekerjaan }}</td>
                                    <td>{{ $item->notelp }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>
                                        <div class="d-flex align-items-center" style="gap: 10px;">
                                            <a href="/resident/{{ $item->id }}" class="d-inline block btn btn-sm btn-warning">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#konfirmasiDelete-{{ $item->id }}">
                                                <i class="fas fa-eraser"></i>
                                            </button>
                                            @if (!is_null($item->user_id))
                                                <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#detailAkun-{{ $item->id }}">
                                                Lihat Akun
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                 </tr>   
                                 @include('pages.resident.konfirmasi-delete')
                                 @include('pages.resident.detail-akun')
                                @endforeach
                                
                            </tbody>
                            @endif
                        </table>   
                    </div>
                    @if($residents->lastPage() > 1)
                    <div class="card-footer">
                        {{ $residents->links('pagination::bootstrap-5')}}
                    </div>
                    @endif
                </div>
            </div>
        </div>
 @endsection
