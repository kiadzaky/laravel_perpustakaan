<?php

use Illuminate\Database\Seeder;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('akun')->insert([
                'username' => 'admin',
                'password'=> password_hash('123',1),
                'nama_akun'=>'kia'
    		]);
    }
}
