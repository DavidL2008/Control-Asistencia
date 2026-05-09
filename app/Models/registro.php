<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class registro extends Model
{
    use HasFactory;
    protected $table = 'registro';
    protected $fillable = [
        'profesor_id',
        'horario_id',
        'fecha_registro',
        'hora_registro',
        'estado',
        'asistencia'

    ];

    public function profesor()
    {
        return $this->belongsTo(profesor::class);
    }
    public function horario()
    {
        return $this->belongsTo(horario::class);
    }

}
