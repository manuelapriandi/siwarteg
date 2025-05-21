<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redis;

class ResidentController extends Controller
{
    public function index()
    {
        $residents = Resident::all();
        return view('pages.resident.index',[
            'residents' => $residents,
        ]);
    }

    public function create() 
    {
        return view('pages.resident.create');
    }

    public function store(Request $request) 
    {
        $validated = $request->validate([
            'nik' => ['required', 'min:16', 'max:16'],
            'nama' => ['required', 'max:95'],
            'jk' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'tgl_lahir' => ['required', 'string'],
            'tmpt_lahir' => ['required', 'max:100'],
            'alamat' => ['required', 'max:300'],
            'agama' => ['nullable', 'max:40'],
            'status_kwn' => ['required', Rule::in(['Belum menikah', 'Menikah', 'Cerai', 'Ibu/Bapak Tunggal'])],
            'pekerjaan' => ['nullable', 'max:65'],
            'notelp' => ['nullable', 'max:15'],
            'status' => ['required', Rule::in(['aktif', 'pindah', 'meninggal'])],

        ]);    

        Resident::create($request->validated());

        return redirect('/resident')->with('sukses', 'Berhasil menambahkan data');
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nik' => ['required', 'min:16', 'max:16'],
            'nama' => ['required', 'max:95'],
            'jk' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'tgl_lahir' => ['required', 'string'],
            'tmpt_lahir' => ['required', 'max:100'],
            'alamat' => ['required', 'max:300'],
            'agama' => ['nullable', 'max:40'],
            'status_kwn' => ['required', Rule::in(['Belum menikah', 'Menikah', 'Cerai', 'Ibu/Bapak Tunggal'])],
            'pekerjaan' => ['nullable', 'max:65'],
            'notelp' => ['nullable', 'max:15'],
            'status' => ['required', Rule::in(['aktif', 'pindah', 'meninggal'])],

        ]);    

        Resident::findOrFail($id)->update($request->validated());

        return redirect('/resident')->with('sukses', 'Berhasil mengubah data');
    }


    public function edit($id) 
    {
        $resident = Resident::findOrFail($id);

        return view('pages.resident.edit', [ 'resident' => $resident,]);
    }


    public function destroy($id) 
    {
        $resident = Resident::findOrFail($id);
        $resident -> delete();

        return redirect('/resident')->with('sukses', 'Berhasil menghapus data');
    }
}
