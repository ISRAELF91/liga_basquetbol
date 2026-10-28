<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listado de Jugadores') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="mb-6">
                    <a href="{{ route('jugadores.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        + Registrar Nuevo Jugador
                    </a>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="py-4 px-6 bg-gray-100 font-bold uppercase text-sm text-gray-600 border-b border-gray-200">ID</th>
                            <th class="py-4 px-6 bg-gray-100 font-bold uppercase text-sm text-gray-600 border-b border-gray-200">Nombre</th>
                            <th class="py-4 px-6 bg-gray-100 font-bold uppercase text-sm text-gray-600 border-b border-gray-200">Posición</th>
                            <th class="py-4 px-6 bg-gray-100 font-bold uppercase text-sm text-gray-600 border-b border-gray-200">N°</th>
                            <th class="py-4 px-6 bg-gray-100 font-bold uppercase text-sm text-gray-600 border-b border-gray-200">Equipo</th>
                            <th class="py-4 px-6 bg-gray-100 font-bold uppercase text-sm text-gray-600 border-b border-gray-200">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jugadores as $jugador)
                            <tr class="hover:bg-gray-50">
                                <td class="py-4 px-6 border-b border-gray-200">{{ $jugador->id }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $jugador->nombre }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $jugador->posicion }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $jugador->numero }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $jugador->equipo->nombre }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">
                                    <a href="{{ route('jugadores.edit', $jugador->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded mr-2">Editar</a>
                                    <form action="{{ route('jugadores.destroy', $jugador->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded" onclick="return confirm('¿Estás seguro de que deseas eliminar este jugador?')">Eliminar</button>
                                    </form>                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>