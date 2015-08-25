<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'indicadores';
    protected $hidden = array('id','created_at', 'updated_at');

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['indicador', 'nombre'];
}
