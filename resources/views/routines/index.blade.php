<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Mis rutinas</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto px-4">

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        <div class="flex justify-between items-center mb-4">
            <h3 class="text-gray-600">Historial de entrenamientos</h3>
            <a href="{{ route('routines.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
                + Registrar hoy
            </a>
        </div>

        @forelse($routines as $routine)
            <div class="bg-white shadow rounded-xl p-5 mb-4">

                <div class="flex justify-between items-center mb-3">
                    <div>
                        <span class="font-semibold text-gray-800">
                            {{ $routine->date->format('d/m/Y') }}
                        </span>
                        <span class="text-xs text-gray-400 ml-2">
                            {{ $routine->date->locale('es')->dayName }}
                        </span>
                    </div>
                    <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded-full">
                        {{ $routine->routineExercises->count() }} ejercicio(s)
                    </span>
                </div>

                @if($routine->notes)
                    <p class="text-sm text-gray-500 mb-3 italic">{{ $routine->notes }}</p>
                @endif

                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-xs text-gray-400 border-b">
                            <th class="pb-1">Ejercicio</th>
                            <th class="pb-1">Músculo</th>
                            <th class="pb-1 text-center">Series</th>
                            <th class="pb-1 text-center">Reps</th>
                            <th class="pb-1 text-center">Peso</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($routine->routineExercises as $item)
                            <tr class="border-b last:border-0">
                                <td class="py-1">{{ $item->exercise->name }}</td>
                                <td class="py-1 text-gray-400">{{ $item->exercise->muscle->name ?? '—' }}</td>
                                <td class="py-1 text-center">{{ $item->sets }}</td>
                                <td class="py-1 text-center">{{ $item->reps }}</td>
                                <td class="py-1 text-center">
                                    {{ $item->weight ? $item->weight . ' kg' : '—' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        @empty
            <div class="bg-white rounded-xl shadow p-8 text-center text-gray-400">
                <p class="text-4xl mb-3">💪</p>
                <p>Aún no tienes rutinas registradas.</p>
                <a href="{{ route('routines.create') }}"
                   class="inline-block mt-3 text-blue-600 hover:underline text-sm">
                    Registra tu primera rutina
                </a>
            </div>
        @endforelse

        <div class="mt-4">{{ $routines->links() }}</div>

    </div>
</x-app-layout>