<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listado de Partidos') }}
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
                    <a href="{{ route('partidos.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        + Programar Nuevo Partido
                    </a>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="py-4 px-6 bg-gray-100 font-bold uppercase text-sm text-gray-600 border-b border-gray-200">ID</th>
                            <th class="py-4 px-6 bg-gray-100 font-bold uppercase text-sm text-gray-600 border-b border-gray-200">Local</th>
                            <th class="py-4 px-6 bg-gray-100 font-bold uppercase text-sm text-gray-600 border-b border-gray-200">Visitante</th>
                            <th class="py-4 px-6 bg-gray-100 font-bold uppercase text-sm text-gray-600 border-b border-gray-200">Resultado</th>
                            <th class="py-4 px-6 bg-gray-100 font-bold uppercase text-sm text-gray-600 border-b border-gray-200">Fecha</th>
                            <th class="py-4 px-6 bg-gray-100 font-bold uppercase text-sm text-gray-600 border-b border-gray-200">Estado</th>
                            <th class="py-4 px-6 bg-gray-100 font-bold uppercase text-sm text-gray-600 border-b border-gray-200">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($partidos as $partido)
                            <tr class="hover:bg-gray-50">
                                <td class="py-4 px-6 border-b border-gray-200">{{ $partido->id }}</td>
                                <td class="py-4 px-6 border-b border-gray-200 font-bold">{{ $partido->equipoLocal->nombre }}</td>
                                <td class="py-4 px-6 border-b border-gray-200 font-bold">{{ $partido->equipoVisitante->nombre }}</td>
                                <td class="py-4 px-6 border-b border-gray-200 font-bold text-center text-lg">
                                    @if($partido->estado == 'Jugado')
                                        {{ $partido->puntos_local }} - {{ $partido->puntos_visitante }}
                                    @else
                                        VS
                                    @endif
                                </td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ \Carbon\Carbon::parse($partido->fecha_partido)->format('d/m/Y H:i') }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $partido->estado }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 border-b border-gray-200">
                                    <a href="{{ route('partidos.edit', $partido->id) }}" class="text-indigo-600 hover:text-indigo-900 font-bold mr-3">Editar / Resultado</a>
                                    <form action="{{ route('partidos.destroy', $partido->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 font-bold" onclick="return confirm('¿Eliminar este partido?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>