<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listado de Equipos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <!-- Mensaje de éxito -->
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Botón Crear -->
                <div class="mb-4">
                    <a href="{{ route('equipos.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        + Crear Nuevo Equipo
                    </a>
                </div>
                

                <!-- Tabla de Equipos -->
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="py-4 px-6 bg-gray-100 font-bold uppercase text-sm text-gray-600 border-b border-gray-200">ID</th>
                            <th class="py-4 px-6 bg-gray-100 font-bold uppercase text-sm text-gray-600 border-b border-gray-200">Nombre</th>
                            <th class="py-4 px-6 bg-gray-100 font-bold uppercase text-sm text-gray-600 border-b border-gray-200">Ciudad</th>
                            <th class="py-4 px-6 bg-gray-100 font-bold uppercase text-sm text-gray-600 border-b border-gray-200">Entrenador</th>
                            <th class="py-4 px-6 bg-gray-100 font-bold uppercase text-sm text-gray-600 border-b border-gray-200">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($equipos as $equipo)
                            <tr class="hover:bg-gray-50">
                                <td class="py-4 px-6 border-b border-gray-200">{{ $equipo->id }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $equipo->nombre }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $equipo->ciudad }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $equipo->entrenador }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">
                                    <a href="{{ route('equipos.edit', $equipo->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                        Editar
                                    </a>

                                    <form action="{{ route('equipos.destroy', $equipo->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('¿Estás seguro de que deseas eliminar este equipo?')">
                                            Eliminar
                                        </button>
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