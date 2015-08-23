<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UbicacionGeografica extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ubicaciones_geograficas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['codigo', 'nombre'];
}
