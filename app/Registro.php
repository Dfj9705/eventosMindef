<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $fillable = [
        'user', 'evento_id', 'token',
    ];

    public function usuario()
    {
        return $this->belongsToMany(User::class, 'user_id');
    }

    public function evento()
    {
        return $this->belongsToMany(Registro::class, 'id');
    }

    public function ingreso()
    {
        return $this->hasOne(Ingreso::class);

    }

}
