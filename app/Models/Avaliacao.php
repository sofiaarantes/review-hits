<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $table = 'avaliacoes';
    
    protected $fillable = [
        'nota',
        'comentario',
        'usuario_id',
        'musica_id',
    ];

    public function musica()
    {
        return $this->belongsTo(Musica::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
