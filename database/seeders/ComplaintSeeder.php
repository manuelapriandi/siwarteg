<?php

namespace Database\Seeders;

use App\Models\Complaint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Complaint::create([
            'resident_id' => 1,
            'title' => 'Sampah menumpuk di selokan, Pak RT',
            'content' => 'Halo Pak RT, selokannya mampet sama sampah pak, tolong bapak lihat CCTV biar tau siapa yang buang sampah di selokan.'
        ]);
    }
}
