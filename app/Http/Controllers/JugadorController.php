<?php

namespace App\Http\Controllers;

use App\Models\Jugador;
use App\Models\Equipo; // Importamos el modelo Equipo para el menú desplegable
use Illuminate\Http\Request;

class JugadorController extends Controller
{
    public function index()
    {
        // Traemos todos los jugadores y también la información de su equipo asociado
        $jugadores = Jugador::with('equipo')->get();
        return view('jugadores.index', compact('jugadores'));
    }

    public function create()
    {
        // Traemos todos los equipos de la base de datos para pasarlos al formulario
        $equipos = Equipo::all();
        return view('jugadores.create', compact('equipos'));
    }

    public function store(Request $request)
    {
        // Validamos que los datos ingresados sean correctos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'posicion' => 'required|string|max:255',
            'numero' => 'required|integer',
            'equipo_id' => 'required|exists:equipos,id', // Verifica que el equipo exista
        ]);

        // Guardamos el jugador en la base de datos
        Jugador::create($request->all());

        // Redireccionamos a la lista con un mensaje de éxito
        return redirect()->route('jugadores.index')->with('success', 'Jugador registrado exitosamente.');
    }
    public function edit(Jugador $jugadore) // Laravel usa 'jugadore' por defecto al singularizar en español
    {
        $equipos = Equipo::all();
        // Nota: usamos $jugadore porque es el nombre de variable que Laravel inyecta automáticamente aquí
        return view('jugadores.edit', ['jugador' => $jugadore, 'equipos' => $equipos]);
    }

    public function update(Request $request, Jugador $jugadore)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'posicion' => 'required|string|max:255',
            'numero' => 'required|integer',
            'equipo_id' => 'required|exists:equipos,id',
        ]);

        $jugadore->update($request->all());

        return redirect()->route('jugadores.index')->with('success', 'Jugador actualizado exitosamente.');
    }

    public function destroy(Jugador $jugadore)
    {
        $jugadore->delete();
        return redirect()->route('jugadores.index')->with('success', 'Jugador eliminado exitosamente.');
    }

    // ... (deja las demás funciones show, edit, update, destroy tal como están)
}