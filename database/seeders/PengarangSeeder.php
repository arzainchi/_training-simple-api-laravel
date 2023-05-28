<?php

namespace Database\Seeders;

use App\Models\Pengarang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create("id_ID");
        for ($i=0; $i < 10; $i++) {
            Pengarang::create([
                "nama" => $faker->name,
                "jenis_kelamin" => $faker->randomElement(["L", "P"]),
                "tanggal_lahir" => $faker->date("Y-m-d", "now"),
                "alamat" => $faker->sentence,
            ]);
        }
    }
}
