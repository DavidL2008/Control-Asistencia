<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesordetalle extends Model
{
    use HasFactory;
    protected $table = 'profesordetalle';
    protected $fillable = [
        'profesor_id',
        'area_id',
        'cargo_id',
        'horario_id'
    ];

    public function profesor()
    {
        return $this->belongsTo(profesor::class);
    }
    public function area()
    {
        return $this->belongsTo(area::class);
    }
    public function cargo()
    {
        return $this->belongsTo(cargo::class);
    }
    public function horario()
    {
        return $this->belongsTo(horario::class);
    }
}
