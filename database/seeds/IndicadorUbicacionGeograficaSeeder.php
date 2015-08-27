<?php

use Illuminate\Database\Seeder;

class IndicadorUbicacionGeograficaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('indicadores_ubicaciones_geograficas')->delete();

        $indicadores_ubicaciones_geograficas = array(
            ['indicador_id' => 1, 'ubicacion_geografica_id' => 1, 'periodo' => 2010, 'valor' => 1490668.00,'unidad' => 'Numero de personas', 'created_at' => \Carbon\Carbon::now()],
            ['indicador_id' => 1, 'ubicacion_geografica_id' => 1, 'periodo' => 2005, 'valor' =>1367692.00,'unidad' => 'Numero de personas', 'created_at' => \Carbon\Carbon::now()],
            ['indicador_id' => 1, 'ubicacion_geografica_id' => 1, 'periodo' => 2000, 'valor' =>1353610.00,'unidad' => 'Numero de personas', 'created_at' => \Carbon\Carbon::now()],
            ['indicador_id' => 1, 'ubicacion_geografica_id' => 1, 'periodo' => 1995, 'valor' =>1336496.00,'unidad' => 'Numero de personas', 'created_at' => \Carbon\Carbon::now()],
            ['indicador_id' => 1, 'ubicacion_geografica_id' => 1, 'periodo' => 1990, 'valor' =>1276323.00,'unidad' => 'Numero de personas', 'created_at' => \Carbon\Carbon::now()],
            ['indicador_id' => 1, 'ubicacion_geografica_id' => 1, 'periodo' => 1980, 'valor' =>1136830.00,'unidad' => 'Numero de personas', 'created_at' => \Carbon\Carbon::now()],
            ['indicador_id' => 1, 'ubicacion_geografica_id' => 1, 'periodo' => 1970, 'valor' =>951462.00,'unidad' => 'Numero de personas', 'created_at' => \Carbon\Carbon::now()],
            ['indicador_id' => 1, 'ubicacion_geografica_id' => 1, 'periodo' => 1960, 'valor' =>817831.00,'unidad' => 'Numero de personas', 'created_at' => \Carbon\Carbon::now()],
            ['indicador_id' => 1, 'ubicacion_geografica_id' => 1, 'periodo' => 1950, 'valor' =>665524.00,'unidad' => 'Numero de personas', 'created_at' => \Carbon\Carbon::now()],
            ['indicador_id' => 1, 'ubicacion_geografica_id' => 1, 'periodo' => 1940, 'valor' =>565437.00,'unidad' => 'Numero de personas', 'created_at' => \Carbon\Carbon::now()],['indicador_id' => 1, 'ubicacion_geografica_id' => 1, 'periodo' => 1930, 'valor' =>459047.00, 'unidad' => 'Numero de personas', 'created_at' => \Carbon\Carbon::now()],
            ['indicador_id' => 1, 'ubicacion_geografica_id' => 1, 'periodo' => 1921, 'valor' =>379329.00,'unidad' => 'Numero de personas', 'created_at' => \Carbon\Carbon::now()],
            ['indicador_id' => 1, 'ubicacion_geografica_id' => 1, 'periodo' => 1910, 'valor' =>477556.00,'unidad' => 'Numero de personas', 'created_at' => \Carbon\Carbon::now()],

            ['indicador_id' => 1, 'ubicacion_geografica_id' => 2, 'periodo' => 2010, 'valor' => 637026.00,'unidad' => 'Numero de personas', 'created_at' => \Carbon\Carbon::now()],
            ['indicador_id' => 1, 'ubicacion_geografica_id' => 2, 'periodo' => 2005, 'valor' =>512170.00,'unidad' => 'Numero de personas', 'created_at' => \Carbon\Carbon::now()],
            ['indicador_id' => 1, 'ubicacion_geografica_id' => 2, 'periodo' => 2000, 'valor' =>424041.00,'unidad' => 'Numero de personas', 'created_at' => \Carbon\Carbon::now()],
            ['indicador_id' => 1, 'ubicacion_geografica_id' => 2, 'periodo' => 1995, 'valor' =>375494.00,'unidad' => 'Numero de personas', 'created_at' => \Carbon\Carbon::now()],
            ['indicador_id' => 1, 'ubicacion_geografica_id' => 2, 'periodo' => 1990, 'valor' =>317764.00,'unidad' => 'Numero de personas', 'created_at' => \Carbon\Carbon::now()],
            ['indicador_id' => 1, 'ubicacion_geografica_id' => 2, 'periodo' => 1980, 'valor' =>215139.00,'unidad' => 'Numero de personas', 'created_at' => \Carbon\Carbon::now()],
            ['indicador_id' => 1, 'ubicacion_geografica_id' => 2, 'periodo' => 1970, 'valor' =>128019.00,'unidad' => 'Numero de personas', 'created_at' => \Carbon\Carbon::now()],
            ['indicador_id' => 1, 'ubicacion_geografica_id' => 2, 'periodo' => 1960, 'valor' =>81594.00,'unidad' => 'Numero de personas', 'created_at' => \Carbon\Carbon::now()],
            ['indicador_id' => 1, 'ubicacion_geografica_id' => 2, 'periodo' => 1950, 'valor' =>60864.00,'unidad' => 'Numero de personas', 'created_at' => \Carbon\Carbon::now()],
            ['indicador_id' => 1, 'ubicacion_geografica_id' => 2, 'periodo' => 1940, 'valor' =>51471.00,'unidad' => 'Numero de personas', 'created_at' => \Carbon\Carbon::now()],['indicador_id' => 1, 'ubicacion_geografica_id' => 2, 'periodo' => 1930, 'valor' =>47089.00, 'unidad' => 'Numero de personas', 'created_at' => \Carbon\Carbon::now()],
            ['indicador_id' => 1, 'ubicacion_geografica_id' => 2, 'periodo' => 1921, 'valor' =>39294.00,'unidad' => 'Numero de personas', 'created_at' => \Carbon\Carbon::now()],
            ['indicador_id' => 1, 'ubicacion_geografica_id' => 2, 'periodo' => 1910, 'valor' => 0,'unidad' => 'Numero de personas', 'created_at' => \Carbon\Carbon::now()],

            ['indicador_id' => 2, 'ubicacion_geografica_id' => 1, 'periodo' => 2005, 'valor' => 75539.30,'unidad' => 'Kilometros cuadrados', 'created_at' => \Carbon\Carbon::now()],

            ['indicador_id' => 2, 'ubicacion_geografica_id' => 2, 'periodo' => 2005, 'valor' => 73922.47,'unidad' => 'Kilometros cuadrados', 'created_at' => \Carbon\Carbon::now()],







        );

        foreach($indicadores_ubicaciones_geograficas as $indicador_ubicacion_geografica)
        {
            \App\IndicadorUbicacionGeografica::create($indicador_ubicacion_geografica);
        }

    }
}
