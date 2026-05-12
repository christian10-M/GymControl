<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Ejercicios</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between mb-4">
            <h3 class="text-lg">Lista de ejercicios</h3>
            <a href="{{ route('exercises.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Nuevo
            </a>
        </div>

        <table class="w-full border-collapse bg-white shadow rounded">
            <thead class="bg-gray-100">
                <tr>
                    <th class="text-left p-3 border-b">Nombre</th>
                    <th class="text-left p-3 border-b">Músculo</th>
                    <th class="text-left p-3 border-b">Dificultad</th>
                    <th class="p-3 border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($exercises as $exercise)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ $exercise->name }}</td>
                    <td class="p-3">{{ $exercise->muscle->name }}</td>
                    <td class="p-3">{{ $exercise->difficulty ?? '—' }}</td>
                    <td class="p-3 text-center space-x-2">
                        <a href="{{ route('exercises.edit', $exercise) }}"
                           class="text-blue-600 hover:underline">Editar</a>

                        <form action="{{ route('exercises.destroy', $exercise) }}"
                              method="POST" class="inline"
                              onsubmit="return confirm('¿Eliminar este ejercicio?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">{{ $exercises->links() }}</div>
    </div>
</x-app-layout>