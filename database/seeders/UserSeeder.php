<?php

namespace Database\Seeders;

use App\Models\Resident;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'name' => 'Admin SiWarTeg',
            'email' => 'adminsiwarteg@gmail.com',
            'password' => 'admin',
            'status' => 'approved',
            'role_id' => '1', //Artinya buat ID Adminnya

        ]);

        User::create([
            'id' => 2,
            'name' => 'Warga 1',
            'email' => 'warga1@gmail.com',
            'password' => 'warga',
            'status' => 'approved',
            'role_id' => '2', //Artinya buat ID Warga

        ]);

        Resident::create([
            'user_id' => 2,
            'nik' => '1111222233334444',
            'nama' => 'Manuu',
            'jk' => 'Laki-laki',
            'tgl_lahir' => '2000-01-01',
            'tmpt_lahir' => 'Bandung',
            'alamat' => 'Bojong Indah',
            'status_kwn' => 'Belum Menikah',

        ]);
    }
}
