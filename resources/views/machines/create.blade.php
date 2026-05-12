<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Nueva máquina</h2>
    </x-slot>

    <div class="py-6 max-w-lg mx-auto bg-white shadow rounded p-6">

        <form action="{{ route('machines.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Nombre</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full border rounded p-2 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Músculo</label>
                <select name="muscle_id"
                        class="w-full border rounded p-2 @error('muscle_id') border-red-500 @enderror">
                    <option value="">— Selecciona —</option>
                    @foreach($muscles as $muscle)
                        <option value="{{ $muscle->id }}"
                            {{ old('muscle_id') == $muscle->id ? 'selected' : '' }}>
                            {{ $muscle->name }}
                        </option>
                    @endforeach
                </select>
                @error('muscle_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Estado</label>
                <select name="status" class="w-full border rounded p-2">
                    <option value="available"        {{ old('status') == 'available'        ? 'selected' : '' }}>Disponible</option>
                    <option value="maintenance"      {{ old('status') == 'maintenance'      ? 'selected' : '' }}>Mantenimiento</option>
                    <option value="out_of_service"   {{ old('status') == 'out_of_service'   ? 'selected' : '' }}>Fuera de servicio</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Descripción</label>
                <textarea name="description" rows="3"
                          class="w-full border rounded p-2">{{ old('description') }}</textarea>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Guardar
                </button>
                <a href="{{ route('machines.index') }}"
                   class="px-4 py-2 border rounded hover:bg-gray-100">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</x-app-layout>