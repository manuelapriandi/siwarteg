<?php

namespace Database\Seeders;

use Database\Factories\ResidentFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Resident;

class ResidentSeeder extends Seeder
{
    public function run(): void
    {
        Resident::factory()->count(30)->create(); // Buat 20 data resident
    }
}
