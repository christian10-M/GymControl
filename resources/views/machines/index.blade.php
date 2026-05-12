<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Máquinas</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between mb-4">
            <h3 class="text-lg">Lista de máquinas</h3>
            <a href="{{ route('machines.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Nueva
            </a>
        </div>

        <table class="w-full border-collapse bg-white shadow rounded">
            <thead class="bg-gray-100">
                <tr>
                    <th class="text-left p-3 border-b">Nombre</th>
                    <th class="text-left p-3 border-b">Músculo</th>
                    <th class="text-left p-3 border-b">Estado</th>
                    <th class="p-3 border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($machines as $machine)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ $machine->name }}</td>
                    <td class="p-3">{{ $machine->muscle->name }}</td>
                    <td class="p-3">{{ $machine->status }}</td>
                    <td class="p-3 text-center space-x-2">
                        <a href="{{ route('machines.edit', $machine) }}"
                           class="text-blue-600 hover:underline">Editar</a>

                        <form action="{{ route('machines.destroy', $machine) }}"
                              method="POST" class="inline"
                              onsubmit="return confirm('¿Eliminar esta máquina?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">{{ $machines->links() }}</div>
    </div>
</x-app-layout>