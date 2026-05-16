<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-3xl font-bold text-white">
                Editar Ejercicio
            </h2>

            <p class="text-gray-400 mt-1">
                Modifica la información del ejercicio
            </p>
        </div>
    </x-slot>

    <div class="p-4 md:p-8">

        <div class="max-w-3xl mx-auto">

            <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-6 md:p-8">

                <form
                    action="{{ route('exercises.update', $exercise) }}"
                    method="POST"
                    class="space-y-6">

                    @csrf
                    @method('PUT')

                    {{-- NOMBRE --}}
                    <div>

                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Nombre
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $exercise->name) }}"
                            placeholder="Ej: Press banca"

                            class="w-full rounded-2xl border
                                   border-white/10
                                   bg-black/20
                                   px-4 py-3
                                   text-white
                                   placeholder-gray-500
                                   focus:border-emerald-400
                                   focus:ring
                                   focus:ring-emerald-400/20
                                   outline-none transition
                                   @error('name') border-red-500 @enderror">

                        @error('name')
                            <p class="text-red-400 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- MÚSCULO --}}
                    <div>

                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Músculo
                        </label>

                        <select
                            name="muscle_id"

                            class="w-full rounded-2xl border
                                   border-white/10
                                   bg-black/20
                                   px-4 py-3
                                   text-white
                                   focus:border-emerald-400
                                   focus:ring
                                   focus:ring-emerald-400/20
                                   outline-none transition
                                   @error('muscle_id') border-red-500 @enderror">

                            <option value="">
                                Selecciona un músculo
                            </option>

                            @foreach($muscles as $muscle)

                                <option
                                    value="{{ $muscle->id }}"
                                    {{ old('muscle_id', $exercise->muscle_id) == $muscle->id ? 'selected' : '' }}>

                                    {{ $muscle->name }}

                                </option>

                            @endforeach

                        </select>

                        @error('muscle_id')
                            <p class="text-red-400 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- DIFICULTAD --}}
                    <div>

                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Dificultad
                        </label>

                        <select
                            name="difficulty"

                            class="w-full rounded-2xl border
                                   border-white/10
                                   bg-black/20
                                   px-4 py-3
                                   text-white
                                   focus:border-emerald-400
                                   focus:ring
                                   focus:ring-emerald-400/20
                                   outline-none transition">

                            <option value="">
                                Opcional
                            </option>

                            <option
                                value="beginner"
                                {{ old('difficulty', $exercise->difficulty) == 'beginner' ? 'selected' : '' }}>
                                Principiante
                            </option>

                            <option
                                value="intermediate"
                                {{ old('difficulty', $exercise->difficulty) == 'intermediate' ? 'selected' : '' }}>
                                Intermedio
                            </option>

                            <option
                                value="advanced"
                                {{ old('difficulty', $exercise->difficulty) == 'advanced' ? 'selected' : '' }}>
                                Avanzado
                            </option>

                        </select>

                    </div>

                    {{-- DESCRIPCIÓN --}}
                    <div>

                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Descripción
                        </label>

                        <textarea
                            name="description"
                            rows="5"

                            placeholder="Describe el ejercicio..."

                            class="w-full rounded-2xl border
                                   border-white/10
                                   bg-black/20
                                   px-4 py-3
                                   text-white
                                   placeholder-gray-500
                                   focus:border-emerald-400
                                   focus:ring
                                   focus:ring-emerald-400/20
                                   outline-none transition">{{ old('description', $exercise->description) }}</textarea>

                    </div>

                    {{-- ACTIONS --}}
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">

                        <button
                            type="submit"

                            class="flex-1 py-3 rounded-2xl
                                   bg-emerald-500 hover:bg-emerald-400
                                   text-black font-semibold
                                   transition hover:scale-[1.01]">

                            Actualizar ejercicio

                        </button>

                        <a
                            href="{{ route('exercises.index') }}"

                            class="flex-1 py-3 rounded-2xl text-center
                                   border border-white/10
                                   text-gray-300
                                   hover:bg-white/5
                                   transition">

                            Cancelar

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>