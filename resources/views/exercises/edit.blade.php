<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Editar ejercicio</h2>
    </x-slot>

    <div class="py-6 max-w-lg mx-auto bg-white shadow rounded p-6">

        <form action="{{ route('exercises.update', $exercise) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Nombre</label>
                <input type="text" name="name" value="{{ old('name', $exercise->name) }}"
                       class="w-full border rounded p-2 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Músculo</label>
                <select name="muscle_id" class="w-full border rounded p-2">
                    <option value="">— Selecciona —</option>
                    @foreach($muscles as $muscle)
                        <option value="{{ $muscle->id }}"
                            {{ old('muscle_id', $exercise->muscle_id) == $muscle->id ? 'selected' : '' }}>
                            {{ $muscle->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Dificultad</label>
                <select name="difficulty" class="w-full border rounded p-2">
                    <option value="">— Opcional —</option>
                    <option value="beginner"     {{ old('difficulty', $exercise->difficulty) == 'beginner'     ? 'selected' : '' }}>Principiante</option>
                    <option value="intermediate" {{ old('difficulty', $exercise->difficulty) == 'intermediate' ? 'selected' : '' }}>Intermedio</option>
                    <option value="advanced"     {{ old('difficulty', $exercise->difficulty) == 'advanced'     ? 'selected' : '' }}>Avanzado</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Descripción</label>
                <textarea name="description" rows="3"
                          class="w-full border rounded p-2">{{ old('description', $exercise->description) }}</textarea>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Actualizar
                </button>
                <a href="{{ route('exercises.index') }}"
                   class="px-4 py-2 border rounded hover:bg-gray-100">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</x-app-layout>