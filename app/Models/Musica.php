<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Musica extends Model
{
    protected $fillable = [
        'titulo',
        'album',
        'ano_lancamento',
        'genero_id',
        'artista_id',
    ];
    
    public function genero()
    {
        return $this->belongsTo(Genero::class);
    }
    
    public function artista()
    {
        return $this->belongsTo(Artista::class);
    }
    
    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class);
    }
}
