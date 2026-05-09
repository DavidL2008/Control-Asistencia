<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profesor extends Model
{
    use HasFactory;
    protected $table = 'profesor';
    protected $fillable = [
        'nombres',
        'apellidos',
        'DNI',
        'numero',
        'correo',
        'fecha_nacimiento',
        'qr_code',
        'genero'
    ];

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }


}
