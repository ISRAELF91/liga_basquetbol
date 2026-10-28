<?php

namespace App\Http\Controllers;

use App\Models\Partido;
use App\Models\Equipo; // Importamos los equipos
use Illuminate\Http\Request;

class PartidoController extends Controller
{
    public function index()
    {
        // Traemos los partidos junto con la información de ambos equipos
        $partidos = Partido::with(['equipoLocal', 'equipoVisitante'])->get();
        return view('partidos.index', compact('partidos'));
    }

    public function create()
    {
        // Traemos todos los equipos para los menús desplegables
        $equipos = Equipo::all();
        return view('partidos.create', compact('equipos'));
    }

    public function store(Request $request)
    {
        // Validamos los datos. 'different' evita que un equipo juegue contra sí mismo
        $request->validate([
            'equipo_local_id' => 'required|exists:equipos,id',
            'equipo_visitante_id' => 'required|exists:equipos,id|different:equipo_local_id',
            'fecha_partido' => 'required|date',
        ], [
            'equipo_visitante_id.different' => 'El equipo visitante debe ser diferente al equipo local.'
        ]);

        Partido::create($request->all());

        return redirect()->route('partidos.index')->with('success', 'Partido programado exitosamente.');
    }

    public function edit(Partido $partido)
    {
        $equipos = Equipo::all();
        return view('partidos.edit', compact('partido', 'equipos'));
    }

    public function update(Request $request, Partido $partido)
    {
        $request->validate([
            'equipo_local_id' => 'required|exists:equipos,id',
            'equipo_visitante_id' => 'required|exists:equipos,id|different:equipo_local_id',
            'fecha_partido' => 'required|date',
            'puntos_local' => 'nullable|integer|min:0',
            'puntos_visitante' => 'nullable|integer|min:0',
            'estado' => 'required|string'
        ]);

        $partido->update($request->all());

        return redirect()->route('partidos.index')->with('success', 'Partido actualizado y resultados guardados.');
    }

    public function destroy(Partido $partido)
    {
        $partido->delete();
        return redirect()->route('partidos.index')->with('success', 'Partido eliminado exitosamente.');
    }
}