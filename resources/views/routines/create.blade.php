<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Registrar rutina de hoy</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        <form action="{{ route('routines.store') }}" method="POST" id="routine-form">
            @csrf

            <div class="bg-white shadow rounded p-6 mb-4">
                <label class="block text-sm font-medium mb-1">Notas del día (opcional)</label>
                <input type="text" name="notes" placeholder="Ej: Día de pecho"
                       class="w-full border rounded p-2">
            </div>

            <div id="exercises-container"></div>

            <button type="button" onclick="addExercise()"
                    class="w-full border-2 border-dashed border-gray-300 text-gray-500
                           py-3 rounded-lg hover:border-blue-400 hover:text-blue-500 mb-4">
                + Agregar ejercicio
            </button>

            @error('exercises')
                <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
            @enderror
            @if($errors->any())
    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded text-sm">
        <ul>
            @foreach($errors->all() as $error)
                <li>• {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            <button type="submit"
                    class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 font-semibold">
                Guardar rutina
            </button>
        </form>
    </div>

    @php
        $exerciseData = $exercises->map(fn($e) => [
            'id'     => $e->id,
            'name'   => $e->name,
            'muscle' => $e->muscle?->name ?? 'Sin músculo',
        ])->values();
    @endphp

    <script>
        const availableExercises = @json($exerciseData);
        let count = 0;

        function addExercise() {
            const container = document.getElementById('exercises-container');
            const idx = count++;

            const options = availableExercises.map(e =>
                `<option value="${e.id}">${e.name} (${e.muscle})</option>`
            ).join('');

            const html = `
            <div class="bg-white shadow rounded p-4 mb-3" id="ex-${idx}">
                <div class="flex justify-between items-center mb-3">
                    <span class="font-medium text-sm">Ejercicio ${idx + 1}</span>
                    <button type="button" onclick="removeExercise(${idx})"
                            class="text-red-400 hover:text-red-600 text-sm">✕ Quitar</button>
                </div>
                <div class="grid grid-cols-1 gap-3">
                    <select name="exercises[${idx}][id]" class="w-full border rounded p-2">
                        <option value="">— Selecciona ejercicio —</option>
                        ${options}
                    </select>
                    <div class="grid grid-cols-3 gap-2">
                        <div>
                            <label class="text-xs text-gray-500">Series</label>
                            <input type="number" name="exercises[${idx}][sets]"
                                   min="1" max="99" placeholder="3"
                                   class="w-full border rounded p-2">
                        </div>
                        <div>
                            <label class="text-xs text-gray-500">Repeticiones</label>
                            <input type="number" name="exercises[${idx}][reps]"
                                   min="1" max="999" placeholder="10"
                                   class="w-full border rounded p-2">
                        </div>
                        <div>
                            <label class="text-xs text-gray-500">Peso (kg)</label>
                            <input type="number" name="exercises[${idx}][weight]"
                                   min="0" step="0.5" placeholder="Opcional"
                                   class="w-full border rounded p-2">
                        </div>
                    </div>
                </div>
            </div>`;

            container.insertAdjacentHTML('beforeend', html);
        }

        function removeExercise(idx) {
            document.getElementById(`ex-${idx}`).remove();
        }

        addExercise();
    </script>
</x-app-layout>