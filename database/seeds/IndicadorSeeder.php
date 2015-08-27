<?php

use Illuminate\Database\Seeder;

class IndicadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('indicadores')->delete();

        $indicadores = array(
            ['indicador' => '1002000001', 'nombre' => 'Poblacion Total', 'created_at' => \Carbon\Carbon::now()],
            ['indicador' => '1001000001', 'nombre' => 'Superficie Continental ', 'created_at' => \Carbon\Carbon::now()],
        );

        foreach ($indicadores as $indicador)
        {
            \App\Indicador::create($indicador);
        }



    }
}
