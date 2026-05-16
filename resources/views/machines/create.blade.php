<x-app-layout
    pageTitle="Nueva Máquina"
    pageSubtitle="Registrar nuevo equipamiento"
>

    <div class="max-w-3xl mx-auto">

        <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-6 md:p-8">

            <form action="{{ route('machines.store') }}" method="POST" class="space-y-6">
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
                        placeholder="Ej. Press Inclinado Hammer"
                        class="w-full rounded-2xl border border-white/10 bg-black/20
                               px-4 py-3 text-white placeholder-gray-500
                               focus:border-emerald-400 focus:ring-0
                               @error('name') border-red-500 @enderror"
                    >

                    @error('name')
                        <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- MUSCULO --}}
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Músculo principal
                    </label>

                    <select
                        name="muscle_id"
                        class="w-full rounded-2xl border border-white/10 bg-black/20
                               px-4 py-3 text-white focus:border-emerald-400 focus:ring-0"
                    >
                        <option value="">Selecciona un músculo</option>

                        @foreach($muscles as $muscle)
                            <option
                                value="{{ $muscle->id }}"
                                {{ old('muscle_id') == $muscle->id ? 'selected' : '' }}
                            >
                                {{ $muscle->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('muscle_id')
                        <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div>
    <label class="block text-sm font-medium text-gray-300 mb-2">
        Imagen URL
    </label>

    <input
        type="text"
        name="image"
        value="{{ old('image') }}"
        placeholder="https://..."
        class="w-full rounded-2xl border border-white/10
               bg-white/5 text-white"
    >
</div>
                {{-- STATUS --}}
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Estado
                    </label>

                    <select
                        name="status"
                        class="w-full rounded-2xl border border-white/10 bg-black/20
                               px-4 py-3 text-white focus:border-emerald-400 focus:ring-0"
                    >
                        <option value="available">Disponible</option>
                        <option value="maintenance">Mantenimiento</option>
                        <option value="out_of_service">Fuera de servicio</option>
                    </select>
                </div>

                {{-- DESCRIPCION --}}
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Descripción
                    </label>

                    <textarea
                        name="description"
                        rows="4"
                        placeholder="Describe la máquina..."
                        class="w-full rounded-2xl border border-white/10 bg-black/20
                               px-4 py-3 text-white placeholder-gray-500
                               focus:border-emerald-400 focus:ring-0"
                    >{{ old('description') }}</textarea>
                </div>

                {{-- BUTTONS --}}
                <div class="flex flex-col sm:flex-row gap-4 pt-4">

                    <button
                        type="submit"
                        class="flex-1 rounded-2xl bg-emerald-500 hover:bg-emerald-400
                               text-black font-bold py-3 transition"
                    >
                        Guardar Máquina
                    </button>

                    <a
                        href="{{ route('machines.index') }}"
                        class="flex-1 rounded-2xl border border-white/10 bg-white/5
                               hover:bg-white/10 text-white py-3 text-center transition"
                    >
                        Cancelar
                    </a>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>