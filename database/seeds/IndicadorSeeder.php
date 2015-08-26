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

        $indicadores = ['indicador' => '1002000001', 'nombre' => 'Poblacion Total', 'created_at' => \Carbon\Carbon::now()];

        \App\Indicador::create($indicadores);
    }
}
