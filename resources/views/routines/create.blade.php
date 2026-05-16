<x-app-layout>

    <x-slot name="header">

        <div>
            <h2 class="text-3xl font-bold text-white">
                Registrar Rutina
            </h2>

            <p class="text-[#8b9290] mt-1">
                Guarda los ejercicios realizados hoy
            </p>
        </div>

    </x-slot>

    <div class="p-4 md:p-8">

        <div class="max-w-5xl mx-auto">

            {{-- SUCCESS --}}
            @if(session('success'))

                <div
                    class="mb-6 rounded-2xl
                           border border-emerald-500/20
                           bg-emerald-500/10
                           p-4 text-emerald-300">

                    {{ session('success') }}

                </div>

            @endif

            {{-- ERRORS --}}
            @if($errors->any())

                <div
                    class="mb-6 rounded-2xl
                           border border-red-500/20
                           bg-red-500/10
                           p-4 text-sm text-red-300">

                    <ul class="space-y-1">

                        @foreach($errors->all() as $error)

                            <li>• {{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            {{-- FORM --}}
            <form
                action="{{ route('routines.store') }}"
                method="POST"
                id="routine-form"
                class="space-y-6"
            >

                @csrf

                {{-- NOTES --}}
                <div
                    class="rounded-3xl border border-white/10
                           bg-white/5 backdrop-blur-xl
                           p-6"
                >

                    <label class="block text-sm font-medium text-gray-300 mb-3">
                        Notas del entrenamiento
                    </label>

                    <input
                        type="text"
                        name="notes"
                        placeholder="Ej: Día de pecho y tríceps"

                        class="
                            w-full rounded-2xl
                            border border-white/10
                            bg-black/20
                            px-4 py-4
                            text-white
                            placeholder-gray-500
                            focus:border-emerald-400
                            focus:ring focus:ring-emerald-400/20
                            focus:outline-none
                        "
                    >

                </div>

                {{-- EXERCISES --}}
                <div id="exercises-container" class="space-y-5"></div>

                {{-- ADD BUTTON --}}
                <button
                    type="button"
                    onclick="addExercise()"

                    class="
                        w-full rounded-3xl
                        border-2 border-dashed border-white/10
                        bg-white/[0.03]
                        py-6
                        text-[#8b9290]
                        transition-all

                        hover:border-emerald-400/40
                        hover:bg-emerald-500/5
                        hover:text-emerald-300
                    "
                >

                    + Agregar ejercicio

                </button>

                {{-- SUBMIT --}}
                <button
                    type="submit"

                    class="
                        w-full rounded-3xl
                        bg-emerald-500
                        hover:bg-emerald-400
                        py-4
                        text-black font-bold
                        transition-all
                        hover:scale-[1.01]
                        active:scale-[0.99]
                        shadow-2xl shadow-emerald-500/20
                    "
                >

                    Guardar rutina

                </button>

            </form>

        </div>

    </div>

    @php
        $exerciseData = $exercises->map(fn($e) => [
            'id'       => $e->id,
            'name'     => $e->name,
            'muscle'   => $e->muscle?->name ?? 'Sin músculo',
            'machine'  => \App\Models\Machine::where('muscle_id', $e->muscle_id)->first()?->name ?? 'Sin máquina'
        ])->values();
    @endphp

    <script>

        const availableExercises = @json($exerciseData);

        let count = 0;

        function addExercise() {

            const container = document.getElementById('exercises-container');

            const idx = count++;

            const options = availableExercises.map(e =>

                `<option value="${e.id}">
                    ${e.name} • ${e.muscle} • ${e.machine}
                </option>`

            ).join('');

            const html = `

            <div
                class="rounded-3xl border border-white/10
                       bg-white/5 backdrop-blur-xl
                       p-6"
                id="ex-${idx}"
            >

                {{-- HEADER --}}
                <div class="flex items-center justify-between mb-5">

                    <div>

                        <p class="text-lg font-bold text-white">
                            Ejercicio ${idx + 1}
                        </p>

                        <p class="text-sm text-[#8b9290]">
                            Configura series, repeticiones y peso
                        </p>

                    </div>

                    <button
                        type="button"
                        onclick="removeExercise(${idx})"

                        class="
                            rounded-xl border border-red-500/20
                            bg-red-500/10
                            px-4 py-2
                            text-sm text-red-300
                            transition hover:bg-red-500/20
                        "
                    >

                        Quitar

                    </button>

                </div>

                {{-- EXERCISE --}}
                <div class="mb-5">

                    <label class="block text-sm text-gray-300 mb-2">
                        Ejercicio
                    </label>

                    <select
                        name="exercises[${idx}][id]"

                        class="
                            w-full rounded-2xl
                            border border-white/10
                            bg-black/20
                            px-4 py-4
                            text-white
                            focus:border-emerald-400
                            focus:ring focus:ring-emerald-400/20
                            focus:outline-none
                        "
                    >

                        <option value="">
                            Selecciona un ejercicio
                        </option>

                        ${options}

                    </select>

                </div>

                {{-- DATA --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    {{-- SETS --}}
                    <div>

                        <label class="block text-sm text-gray-300 mb-2">
                            Series
                        </label>

                        <input
                            type="number"
                            name="exercises[${idx}][sets]"
                            min="1"
                            max="99"
                            placeholder="3"

                            class="
                                w-full rounded-2xl
                                border border-white/10
                                bg-black/20
                                px-4 py-4
                                text-white
                                placeholder-gray-500
                                focus:border-emerald-400
                                focus:ring focus:ring-emerald-400/20
                                focus:outline-none
                            "
                        >

                    </div>

                    {{-- REPS --}}
                    <div>

                        <label class="block text-sm text-gray-300 mb-2">
                            Repeticiones
                        </label>

                        <input
                            type="number"
                            name="exercises[${idx}][reps]"
                            min="1"
                            max="999"
                            placeholder="10"

                            class="
                                w-full rounded-2xl
                                border border-white/10
                                bg-black/20
                                px-4 py-4
                                text-white
                                placeholder-gray-500
                                focus:border-emerald-400
                                focus:ring focus:ring-emerald-400/20
                                focus:outline-none
                            "
                        >

                    </div>

                    {{-- WEIGHT --}}
                    <div>

                        <label class="block text-sm text-gray-300 mb-2">
                            Peso (kg)
                        </label>

                        <input
                            type="number"
                            name="exercises[${idx}][weight]"
                            min="0"
                            step="0.5"
                            placeholder="Opcional"

                            class="
                                w-full rounded-2xl
                                border border-white/10
                                bg-black/20
                                px-4 py-4
                                text-white
                                placeholder-gray-500
                                focus:border-emerald-400
                                focus:ring focus:ring-emerald-400/20
                                focus:outline-none
                            "
                        >

                    </div>

                </div>

            </div>

            `;

            container.insertAdjacentHTML('beforeend', html);

        }

        function removeExercise(idx) {

            document.getElementById(`ex-${idx}`).remove();

        }

        addExercise();

    </script>

</x-app-layout>