<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'correo',
        'asunto',
        'mensaje',
        'id_agente',
        'estado',
    ];

    // Relación inversa a User
    public function agente()
    {
        return $this->belongsTo(User::class, 'id_agente');
    }
}
