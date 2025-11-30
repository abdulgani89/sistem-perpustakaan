<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Generate 20 siswa dummy
        for ($i = 1; $i <= 20; $i++) {
            // Buat user untuk siswa
            $user = User::create([
                'username' => 'siswa' . $i,
                'password' => Hash::make('password'),
                'role' => 'siswa',
            ]);

            // Buat data siswa
            Siswa::create([
                'nis' => 2024000 + $i,
                'nama_siswa' => $faker->name(),
                'kelas' => $faker->randomElement(['X-A', 'X-B', 'XI-A', 'XI-B', 'XII-A', 'XII-B']),
                'alamat' => $faker->address(),
                'id_user' => $user->id_user,
            ]);
        }
    }
}
