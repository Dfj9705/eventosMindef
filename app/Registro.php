<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $fillable = [
        'user', 'evento', 'token',
    ];

    public function usuario()
    {
        return $this->belongsToMany(User::class, 'user_id');
    }

    public function evento()
    {
        return $this->belongsToMany(Registro::class, 'id');
    }

}
