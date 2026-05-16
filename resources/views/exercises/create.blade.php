<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-3xl font-bold text-white">
                Nuevo Ejercicio
            </h2>

            <p class="text-gray-400 mt-1">
                Agrega un nuevo movimiento al sistema
            </p>
        </div>
    </x-slot>

    <div class="p-4 md:p-8">

        <div class="max-w-3xl mx-auto">

            <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-6 md:p-8">

                <form action="{{ route('exercises.store') }}" method="POST" class="space-y-6">

                    @csrf

                    {{-- NOMBRE --}}
                    <div>

                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Nombre
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Ej: Press banca"

                            class="w-full rounded-2xl border border-white/10
                                   bg-black/20 px-4 py-3 text-white
                                   placeholder-gray-500
                                   focus:border-emerald-400
                                   focus:ring focus:ring-emerald-400/20">

                        @error('name')
                            <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- MUSCLE --}}
                    <div>

                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Músculo
                        </label>

                        <select
                            name="muscle_id"
                            class="w-full rounded-2xl border border-white/10
                                   bg-black/20 px-4 py-3 text-white
                                   focus:border-emerald-400
                                   focus:ring focus:ring-emerald-400/20">

                            <option value="">Selecciona un músculo</option>

                            @foreach($muscles as $muscle)

                                <option value="{{ $muscle->id }}"
                                    {{ old('muscle_id') == $muscle->id ? 'selected' : '' }}>

                                    {{ $muscle->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- DIFFICULTY --}}
                    <div>

                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Dificultad
                        </label>

                        <select
                            name="difficulty"
                            class="w-full rounded-2xl border border-white/10
                                   bg-black/20 px-4 py-3 text-white">

                            <option value="">Opcional</option>

                            <option value="beginner">Principiante</option>
                            <option value="intermediate">Intermedio</option>
                            <option value="advanced">Avanzado</option>

                        </select>

                    </div>

                    {{-- DESCRIPTION --}}
                    <div>

                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Descripción
                        </label>

                        <textarea
                            name="description"
                            rows="5"

                            class="w-full rounded-2xl border border-white/10
                                   bg-black/20 px-4 py-3 text-white
                                   placeholder-gray-500
                                   focus:border-emerald-400
                                   focus:ring focus:ring-emerald-400/20"

                            placeholder="Describe el ejercicio...">{{ old('description') }}</textarea>

                    </div>

                    {{-- ACTIONS --}}
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">

                        <button
                            type="submit"
                            class="flex-1 py-3 rounded-2xl bg-emerald-500 hover:bg-emerald-400
                                   text-black font-semibold transition hover:scale-[1.01]">

                            Guardar ejercicio

                        </button>

                        <a href="{{ route('exercises.index') }}"
                           class="flex-1 py-3 rounded-2xl text-center
                                  border border-white/10 text-gray-300
                                  hover:bg-white/5 transition">

                            Cancelar

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>