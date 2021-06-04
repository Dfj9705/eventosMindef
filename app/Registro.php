<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function evento()
    {
        return $this->belongsTo(Registro::class, 'id');
    }

}
