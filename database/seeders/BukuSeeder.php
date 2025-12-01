<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Buku;
use Faker\Factory as Faker;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Daftar kategori buku
        $kategori = ['Fiksi', 'Novel', 'Sejarah', 'Teknologi', 'Sains', 'Biografi', 'Pendidikan', 'Agama'];
        
        // Daftar penerbit Indonesia
        $penerbit = ['Gramedia', 'Mizan', 'Bentang Pustaka', 'Erlangga', 'Republika', 'Gema Insani', 'Kompas', 'Andi Publisher'];

        // Generate 50 buku dummy
        for ($i = 0; $i < 50; $i++) {
            Buku::create([
                'judul_buku' => $faker->sentence(rand(2, 5), true), // Judul 2-5 kata
                'pengarang' => $faker->name(),
                'penerbit' => $faker->randomElement($penerbit),
                'kategori' => $faker->randomElement($kategori),
                'status' => $faker->randomElement(['tersedia', 'tersedia', 'tersedia', 'dipinjam']), // 75% tersedia
                'stok' => rand(3, 15), // Stok antara 3-15 buku
                'hilang' => rand(0, 2), // 0-2 buku hilang
                'cover' => null, // Cover bisa diisi nanti
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
