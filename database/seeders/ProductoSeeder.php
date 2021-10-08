<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productos')->truncate();

        DB::table('productos')->insert(
            [
                'descripcion' => Str::random(15),
                'cantidad' => '10'
            ]
        );
    }
}
