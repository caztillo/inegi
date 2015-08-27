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

        $ubicaciones_geograficas = array(
            ['codigo' => '32', 'nombre' => 'Zacatecas', 'created_at' => \Carbon\Carbon::now()],
            ['codigo' => '03', 'nombre' => 'Baja California Sur', 'created_at' => \Carbon\Carbon::now() ]
        );



        foreach($ubicaciones_geograficas as $ubicacion_geografica)
        {
            \App\UbicacionGeografica::create($ubicacion_geografica);
        }
    }
}
