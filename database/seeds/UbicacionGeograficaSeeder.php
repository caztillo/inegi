<?php

use Illuminate\Database\Seeder;

class UbicacionGeograficaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ubicaciones_geograficas')->delete();

        $ubicaciones_geograficas = ['codigo' => '32', 'nombre' => 'Zacatecas', 'created_at' => \Carbon\Carbon::now()];

        \App\UbicacionGeografica::create($ubicaciones_geograficas);
    }
}
