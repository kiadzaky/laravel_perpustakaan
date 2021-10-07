<?php

use Illuminate\Database\Seeder;
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

        for($i = 1; $i <= 3000; $i++){
 
    	      // insert data ke table pegawai menggunakan Faker
    		DB::table('siswa')->insert([
    			'id_siswa' => $faker->uuid(),
    			'nis' => $faker->numberBetween(1000,9999),
    			'nama' => $faker->name,
    			'alamat' => $faker->address,
                'no_telepon' => $faker->phoneNumber
                
    		]);
 
    	}
    }
}
