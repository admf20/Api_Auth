<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            [
                'nombre' => 'Andres',
                'email' => 'Andres@gmail.com',
                'password' => 'monsalve'
            ],
            [
                'nombre' => 'Felipe',
                'email' => 'Felipe@gmail.com',
                'password' => '123'
            ]
        ]);
    }
}
