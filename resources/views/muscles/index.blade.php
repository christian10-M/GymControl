<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Músculos</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between mb-4">
            <h3 class="text-lg">Lista de músculos</h3>
            <a href="{{ route('muscles.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Nuevo
            </a>
        </div>

        <table class="w-full border-collapse bg-white shadow rounded">
            <thead class="bg-gray-100">
                <tr>
                    <th class="text-left p-3 border-b">Nombre</th>
                    <th class="text-left p-3 border-b">Parte del cuerpo</th>
                    <th class="p-3 border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($muscles as $muscle)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ $muscle->name }}</td>
                    <td class="p-3">{{ $muscle->body_part ?? '—' }}</td>
                    <td class="p-3 text-center space-x-2">
                        <a href="{{ route('muscles.edit', $muscle) }}"
                           class="text-blue-600 hover:underline">Editar</a>

                        <form action="{{ route('muscles.destroy', $muscle) }}"
                              method="POST" class="inline"
                              onsubmit="return confirm('¿Eliminar este músculo?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">{{ $muscles->links() }}</div>
    </div>
</x-app-layout>