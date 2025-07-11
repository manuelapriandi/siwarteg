<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class ResidentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::where('role_id', 2)->inRandomOrder()->first()->id, // ambil user yang role-nya warga
            'nik' => $this->faker->unique()->numerify('################'),
            'nama' => $this->faker->name(),
            'jk' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'tgl_lahir' => $this->faker->date('Y-m-d', '2005-01-01'),
            'tmpt_lahir' => $this->faker->city(),
            'alamat' => $this->faker->address(),
            'status_kwn' => $this->faker->randomElement(['Belum Menikah', 'Menikah']),
        ];
    }
}

