<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable = [
        'nombre', 'descripcion', 'fecha','imagen'
    ];

    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
