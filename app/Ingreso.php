<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $fillable = [
        'registro',
    ];
    public function registro()
    {
        return $this->belongsTo(Registro::class, 'registro');
    }
}
