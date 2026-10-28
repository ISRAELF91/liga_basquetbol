<?php

namespace App\Http\Controllers;

use App\Models\Equipo; // <-- Importación obligatoria
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    public function index()
    {
        $equipos = Equipo::all();
        return view('equipos.index', compact('equipos'));
    }

    public function create()
    {
        return view('equipos.create');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'entrenador' => 'nullable|string|max:255',
        ]);

        // Guardar en la base de datos
        Equipo::create($request->all());

        // Redireccionar a la lista con un mensaje
        return redirect()->route('equipos.index')->with('success', 'Equipo creado exitosamente.');
    }
    
    public function edit(Equipo $equipo)
    {
        return view('equipos.edit', compact('equipo'));
    }

    public function update(Request $request, Equipo $equipo)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'entrenador' => 'nullable|string|max:255',
        ]);

        $equipo->update($request->all());

        return redirect()->route('equipos.index')->with('success', 'Equipo actualizado exitosamente.');
    }

    public function destroy(Equipo $equipo)
    {
        $equipo->delete();
        return redirect()->route('equipos.index')->with('success', 'Equipo eliminado exitosamente.');
    }

    // ... (deja las demás funciones show, edit, update, destroy tal como están)
}