<?php
use Illuminate\Database\Seeder;
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
        for($i = 1; $i <= 3000; $i++){
 
    	      // insert data ke table pegawai menggunakan Faker
    		DB::table('buku')->insert([
    			'id_buku' => $faker->uuid(),
    			'judul_buku' =>$faker->title,
    			'penerbit' => $faker->name,
    			'tahun_terbit' => $faker->year,
    		]);
 
    	}
    }
}
