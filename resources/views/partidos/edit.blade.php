<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Partido / Registrar Resultado') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('partidos.update', $partido->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Equipo Local:</label>
                            <select name="equipo_local_id" class="shadow appearance-none border rounded w-full py-2 px-3" required>
                                @foreach($equipos as $equipo)
                                    <option value="{{ $equipo->id }}" {{ $partido->equipo_local_id == $equipo->id ? 'selected' : '' }}>{{ $equipo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Puntos Local:</label>
                            <input type="number" name="puntos_local" value="{{ $partido->puntos_local }}" class="shadow appearance-none border rounded w-full py-2 px-3">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Equipo Visitante:</label>
                            <select name="equipo_visitante_id" class="shadow appearance-none border rounded w-full py-2 px-3" required>
                                @foreach($equipos as $equipo)
                                    <option value="{{ $equipo->id }}" {{ $partido->equipo_visitante_id == $equipo->id ? 'selected' : '' }}>{{ $equipo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Puntos Visitante:</label>
                            <input type="number" name="puntos_visitante" value="{{ $partido->puntos_visitante }}" class="shadow appearance-none border rounded w-full py-2 px-3">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Fecha y Hora:</label>
                        <input type="datetime-local" name="fecha_partido" value="{{ date('Y-m-d\TH:i', strtotime($partido->fecha_partido)) }}" class="shadow appearance-none border rounded w-full py-2 px-3" required>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Estado del Partido:</label>
                        <select name="estado" class="shadow appearance-none border rounded w-full py-2 px-3" required>
                            <option value="Programado" {{ $partido->estado == 'Programado' ? 'selected' : '' }}>Programado</option>
                            <option value="Jugado" {{ $partido->estado == 'Jugado' ? 'selected' : '' }}>Jugado</option>
                        </select>
                    </div>

                    <div class="flex justify-between">
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Guardar Resultados</button>
                        <a href="{{ route('partidos.index') }}" class="text-blue-500 hover:text-blue-800 font-bold py-2">Cancelar</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>