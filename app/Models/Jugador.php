<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    use HasFactory;

    // Campos que permitimos guardar
    protected $fillable = ['nombre', 'posicion', 'numero', 'equipo_id'];

    // Relación: Un jugador pertenece a un equipo
    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
}