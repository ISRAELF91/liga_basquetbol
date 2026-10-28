<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Partido;
use Illuminate\Http\Request;

class EstadisticaController extends Controller
{
    public function index()
    {
        $equipos = Equipo::all();
        $estadisticas = [];

        foreach ($equipos as $equipo) {
            // Buscar los partidos jugados como local y como visitante
            $partidosLocal = Partido::where('equipo_local_id', $equipo->id)->where('estado', 'Jugado')->get();
            $partidosVisitante = Partido::where('equipo_visitante_id', $equipo->id)->where('estado', 'Jugado')->get();

            // Calcular totales
            $partidosJugados = $partidosLocal->count() + $partidosVisitante->count();
            $puntosTotales = $partidosLocal->sum('puntos_local') + $partidosVisitante->sum('puntos_visitante');

            // Guardar en el arreglo
            $estadisticas[] = (object)[
                'equipo' => $equipo->nombre,
                'partidos_jugados' => $partidosJugados,
                'puntos_totales' => $puntosTotales
            ];
        }

        // Ordenar de mayor a menor cantidad de puntos
        usort($estadisticas, function($a, $b) {
            return $b->puntos_totales <=> $a->puntos_totales;
        });

        return view('estadisticas.index', compact('estadisticas'));
    }
}