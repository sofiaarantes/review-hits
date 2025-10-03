<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    protected $fillable = [
        'nome_genero',
    ];
    
    public function musicas()
    {
        return $this->hasMany(Musica::class);
    }
}
