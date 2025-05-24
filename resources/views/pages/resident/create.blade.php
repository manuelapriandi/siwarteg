@extends('layouts.app')

@section('content')
 <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Warga</h1>
        </div>    

        <div class="row">
            <div class="col">
                <form action="/resident" method="post">
                    @csrf
                    @method('POST')
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="nik">NIK</label>
                                <input type="number" inputmode="numeric" name="nik" id="nik" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" name="nama" id="nama" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="jk">Jenis Kelamin</label>
                                <select name="jk" id="jk" class="form-control">
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="tmpt_lahir">Tempat Lahir</label>
                                <input type="text" name="tmpt_lahir" id="tmpt_lahir" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="agama">Agama</label>
                                <input type="text" name="agama" id="agama" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="status_kwn">Status Perkawinan</label>
                                <select name="status_kwn" id="status_kwn" class="form-control">
                                    <option value="Belum Menikah">Belum Menikah</option>
                                    <option value="Menikah">Menikah</option>
                                    <option value="Cerai">Cerai</option>
                                    <option value="Bapak/Ibu Tunggal">Bapak/Ibu Tunggal</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="pekerjaan">Pekerjaan</label>
                                <input type="text" name="pekerjaan" id="pekerjaan" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="notelp">Nomor Telepon</label>
                                <input type="text" inputmode="numeric" name="notelp" id="notelp" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="status">Status Kependudukan</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="aktif">Aktif</option>
                                    <option value="pindah">Pindah</option>
                                    <option value="meninggal">Meninggal</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-end" style="gap: 10px">
                                <a href="/resident" class="btn btn-outline-secondary">
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Simpan Data
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

@endsection