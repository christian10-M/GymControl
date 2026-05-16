<x-app-layout>

    <div class="max-w-3xl mx-auto px-4 py-6">

        {{-- HEADER --}}
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-black text-white">
                Editar músculo
            </h1>

            <p class="text-gray-400 mt-2">
                Modifica la información del grupo muscular.
            </p>
        </div>

        {{-- FORM CARD --}}
        <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-6 md:p-8">

            <form action="{{ route('muscles.update', $muscle) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- NAME --}}
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Nombre
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $muscle->name) }}"
                        class="w-full rounded-2xl border border-white/10 bg-black/20
                               text-white px-4 py-3
                               focus:border-emerald-400 focus:ring focus:ring-emerald-400/20
                               outline-none transition
                               @error('name') border-red-500 @enderror"
                    >

                    @error('name')
                        <p class="text-red-400 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- BODY PART --}}
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Parte del cuerpo
                    </label>

                    <input
                        type="text"
                        name="body_part"
                        value="{{ old('body_part', $muscle->body_part) }}"
                        class="w-full rounded-2xl border border-white/10 bg-black/20
                               text-white px-4 py-3
                               focus:border-cyan-400 focus:ring focus:ring-cyan-400/20
                               outline-none transition"
                    >
                </div>

                {{-- ACTIONS --}}
                <div class="flex flex-col sm:flex-row gap-4 pt-4">

                    <button
                        type="submit"
                        class="flex-1 rounded-2xl bg-cyan-500 hover:bg-cyan-400
                               text-black font-bold py-3 px-6 transition"
                    >
                        Actualizar músculo
                    </button>

                    <a
                        href="{{ route('muscles.index') }}"
                        class="flex-1 rounded-2xl border border-white/10
                               bg-white/5 hover:bg-white/10
                               text-white text-center font-medium
                               py-3 px-6 transition"
                    >
                        Cancelar
                    </a>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>