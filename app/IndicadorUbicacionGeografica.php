<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndicadorUbicacionGeografica extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'indicadores_ubicaciones_geograficas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['periodo', 'valor'];

    public function indicador()
    {
        return $this->belongsTo('App\Indicador');
    }

    public function ubicacion_geografica()
    {
        return $this->belongsTo('App\UbicacionGeografica');
    }
}
