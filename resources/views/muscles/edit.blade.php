<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Editar músculo</h2>
    </x-slot>

    <div class="py-6 max-w-lg mx-auto bg-white shadow rounded p-6">

        <form action="{{ route('muscles.update', $muscle) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Nombre</label>
                <input type="text" name="name" value="{{ old('name', $muscle->name) }}"
                       class="w-full border rounded p-2 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Parte del cuerpo</label>
                <input type="text" name="body_part" value="{{ old('body_part', $muscle->body_part) }}"
                       class="w-full border rounded p-2">
            </div>

            <div class="flex gap-3">
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Actualizar
                </button>
                <a href="{{ route('muscles.index') }}"
                   class="px-4 py-2 border rounded hover:bg-gray-100">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</x-app-layout>