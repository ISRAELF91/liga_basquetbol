<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tabla de Posiciones y Estadísticas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="py-4 px-6 bg-gray-800 text-white font-bold uppercase text-sm border-b border-gray-200">Posición</th>
                            <th class="py-4 px-6 bg-gray-800 text-white font-bold uppercase text-sm border-b border-gray-200">Equipo</th>
                            <th class="py-4 px-6 bg-gray-800 text-white font-bold uppercase text-sm border-b border-gray-200 text-center">Partidos Jugados (PJ)</th>
                            <th class="py-4 px-6 bg-gray-800 text-white font-bold uppercase text-sm border-b border-gray-200 text-center">Puntos Totales (PTS)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estadisticas as $index => $stat)
                            <tr class="hover:bg-gray-100">
                                <td class="py-4 px-6 border-b border-gray-200 font-bold text-lg">{{ $index + 1 }}</td>
                                <td class="py-4 px-6 border-b border-gray-200 font-bold">{{ $stat->equipo }}</td>
                                <td class="py-4 px-6 border-b border-gray-200 text-center">{{ $stat->partidos_jugados }}</td>
                                <td class="py-4 px-6 border-b border-gray-200 text-center font-bold text-blue-600">{{ $stat->puntos_totales }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>