@extends('layouts.app')

@section('content')
 <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Ubah Warga</h1>
        </div>    
        {{-- @if ($errors->any())
            @dd($errors->all())
        @endif --}}
       

        <div class="row">
            <div class="col">
                <form action="/resident/{{ $resident->id }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="nik">NIK</label>
                                <input type="number" inputmode="numeric" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old ('nik', $resident->nik) }}">
                                @error('nik')
                                    <span class="invalid-feedback">
                                        Tolong isi NIK dengan benar (NIK hanya bisa diketik dengan angka).
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old ('nama', $resident->nama) }}">
                                @error('nama')
                                    <span class="invalid-feedback">
                                        Boleh tolong isi nama dengan lengkap/benar?
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="jk">Jenis Kelamin</label>
                                <select name="jk" id="jk" class="form-control @error('jk') is-invalid @enderror">
                                    @foreach ([
                                        (object)["label" => "Laki-laki",
                                        "value" => "Laki-laki"],
                                        (object)["label" => "Perempuan",
                                        "value" => "Perempuan"],
                                    ] as $item)
                                        <option value="{{$item->value}}" @selected(old('jk',$resident->jk) == $item->value)>{{$item->label}}</option>    
                                    @endforeach
                                    
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="tmpt_lahir">Tempat Lahir</label>
                                <input type="text" name="tmpt_lahir" id="tmpt_lahir" class="form-control @error('tmpt_lahir') is-invalid @enderror" value="{{ old ('tmpt_lahir', $resident->tmpt_lahir) }}">
                                @error('tmpt_lahir')
                                    <span class="invalid-feedback">
                                        Anda bisa mengisi tempat lahir.
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old ('tgl_lahir', $resident->tgl_lahir) }}">
                                @error('tgl_lahir')
                                    <span class="invalid-feedback">
                                        Anda bisa mengisi tanggal lahir.
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control  @error('alamat') is-invalid @enderror">{{ old ('alamat', $resident->alamat) }}"</textarea>
                                @error('alamat')
                                    <span class="invalid-feedback">
                                        Boleh isi alamat Anda?
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="agama">Agama</label>
                                <input type="text" name="agama" id="agama" class="form-control @error('agama') is-invalid @enderror" value="{{ old ('agama', $resident->agama) }}">
                                @error('agama')
                                    <span class="invalid-feedback">
                                        Boleh isi Agama Anda?
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="status_kwn">Status Perkawinan</label>
                                <select name="status_kwn" id="status_kwn" class="form-control @error('status_kwn') is-invalid @enderror">
                                    @foreach ([
                                        (object)["label" => "Belum Menikah",
                                        "value" => "Belum Menikah"],
                                        (object)["label" => "Menikah",
                                        "value" => "Menikah"],
                                        (object)["label" => "Cerai",
                                        "value" => "Cerai"],
                                        (object)["label" => "Bapak/Ibu Tunggal",
                                        "value" => "Bapak/Ibu Tunggal"],
                                    ] as $item)
                                        <option value="{{$item->value}}" @selected(old('status_kwn', $resident->status_kwn) == $item->value)>{{$item->label}}</option>    
                                    @endforeach
                                    </select>
                                @error('status_kwn')
                                    <span class="invalid-feedback">
                                        Boleh isi status hubungan Anda?
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="pekerjaan">Pekerjaan</label>
                                <input type="text" name="pekerjaan" id="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror" value="{{ old ('pekerjaan', $resident->pekerjaan) }}">
                                @error('pekerjaan')
                                    <span class="invalid-feedback">
                                        Boleh isi pekerjaan Anda?
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="notelp">Nomor Telepon</label>
                                <input type="text" inputmode="numeric" name="notelp" id="notelp" class="form-control @error('notelp') is-invalid @enderror" value="{{ old ('notelp', $resident->notelp) }}">
                                @error('notelp')
                                    <span class="invalid-feedback">
                                        Boleh isi nomor telepon Anda?
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="status">Status Kependudukan</label>
                                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" >
                                    @foreach ([
                                        (object)["label" => "Aktif",
                                        "value" => "aktif"],
                                        (object)["label" => "Pindah",
                                        "value" => "pindah"],
                                        (object)["label" => "Meninggal",
                                        "value" => "meninggal"],
                                    ] as $item)
                                        <option value="{{$item->value}}" @selected(old('status', $resident->status) == $item->value)>{{$item->label}}</option>    
                                    @endforeach
                                    
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-end" style="gap: 10px">
                                <a href="/resident" class="btn btn-outline-secondary">
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