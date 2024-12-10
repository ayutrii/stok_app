<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class suplierSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $data = [];
    
        for ($i = 0; $i < 10; $i++) {
            $nama_suplier = 'PT. ' . $faker->company;
            $data[] = [
                'nama_suplier'    => $nama_suplier,
                'alamat'          => $faker->address,
                'telp'            => $faker->numerify(
                    $faker->randomElement([
                        '08########',
                        '08#########',
                        '08##########',
                    ])
                ),
                'email'           => 'admin.' . strtolower(str_replace(' ', '_', $nama_suplier)) . '@gmail.com',
                'tgl_terdaftar'   => $faker->date('Y-m-d', 'now'),
                'status'          => 'Aktif'
            ];
        }
    
        DB::table('supliers')->insert($data);
    }
}
