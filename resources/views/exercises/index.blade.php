<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-3xl font-bold text-white">
                Biblioteca de Ejercicios
            </h2>

            <p class="text-gray-400 mt-1">
                Gestiona todos los ejercicios del sistema
            </p>
        </div>
    </x-slot>

    <div class="p-4 md:p-8">

        {{-- SUCCESS --}}
        @if(session('success'))
            <div class="mb-6 bg-emerald-500/15 border border-emerald-500/20 text-emerald-300 px-4 py-3 rounded-2xl">
                {{ session('success') }}
            </div>
        @endif

        {{-- TOP BAR --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

            <div>
                <h3 class="text-xl font-semibold text-white">
                    Lista de ejercicios
                </h3>

                <p class="text-sm text-gray-400">
                    {{ $exercises->total() }} ejercicios registrados
                </p>
            </div>

            <a href="{{ route('exercises.create') }}"
               class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-2xl
                      bg-emerald-500 hover:bg-emerald-400
                      text-black font-semibold transition duration-200 hover:scale-[1.02]">

                <span>+</span>
                <span>Nuevo ejercicio</span>

            </a>

        </div>

        {{-- DESKTOP TABLE --}}
        <div class="hidden lg:block overflow-hidden rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl">

            <table class="w-full">

                <thead class="bg-white/5 border-b border-white/10">
                    <tr class="text-left text-gray-400 text-sm uppercase tracking-wider">

                        <th class="p-5">Ejercicio</th>
                        <th class="p-5">Músculo</th>
                        <th class="p-5">Dificultad</th>
                        <th class="p-5 text-center">Acciones</th>

                    </tr>
                </thead>

                <tbody>

                    @foreach($exercises as $exercise)

                        <tr class="border-b border-white/5 hover:bg-white/5 transition">

                            <td class="p-5">

                                <div>
                                    <p class="font-semibold text-white">
                                        {{ $exercise->name }}
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        ID #{{ $exercise->id }}
                                    </p>
                                </div>

                            </td>

                            <td class="p-5 text-gray-300">
                                {{ $exercise->muscle->name }}
                            </td>

                            <td class="p-5">

                                @php
                                    $difficultyColors = [
                                        'beginner' => 'bg-sky-500/20 text-sky-300',
                                        'intermediate' => 'bg-amber-500/20 text-amber-300',
                                        'advanced' => 'bg-rose-500/20 text-rose-300',
                                    ];
                                @endphp

                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $difficultyColors[$exercise->difficulty] ?? 'bg-white/10 text-gray-300' }}">

                                    {{ ucfirst($exercise->difficulty ?? 'Sin definir') }}

                                </span>

                            </td>

                            <td class="p-5">

                                <div class="flex items-center justify-center gap-3">

                                    <a href="{{ route('exercises.edit', $exercise) }}"
                                       class="px-4 py-2 rounded-xl bg-blue-500/20 text-blue-300 hover:bg-blue-500/30 transition">
                                        Editar
                                    </a>

                                    <form action="{{ route('exercises.destroy', $exercise) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Eliminar este ejercicio?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="px-4 py-2 rounded-xl bg-red-500/20 text-red-300 hover:bg-red-500/30 transition">
                                            Eliminar
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        {{-- MOBILE CARDS --}}
        <div class="grid gap-4 lg:hidden">

            @foreach($exercises as $exercise)

                <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-5">

                    <div class="flex items-start justify-between gap-3">

                        <div>

                            <h3 class="text-lg font-semibold text-white">
                                {{ $exercise->name }}
                            </h3>

                            <p class="text-sm text-gray-400 mt-1">
                                {{ $exercise->muscle->name }}
                            </p>

                        </div>

                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            {{ $difficultyColors[$exercise->difficulty] ?? 'bg-white/10 text-gray-300' }}">

                            {{ ucfirst($exercise->difficulty ?? 'N/A') }}

                        </span>

                    </div>

                    <div class="flex gap-3 mt-5">

                        <a href="{{ route('exercises.edit', $exercise) }}"
                           class="flex-1 text-center py-3 rounded-xl bg-blue-500/20 text-blue-300">
                            Editar
                        </a>

                        <form action="{{ route('exercises.destroy', $exercise) }}"
                              method="POST"
                              class="flex-1"
                              onsubmit="return confirm('¿Eliminar este ejercicio?')">

                            @csrf
                            @method('DELETE')

                            <button class="w-full py-3 rounded-xl bg-red-500/20 text-red-300">
                                Eliminar
                            </button>

                        </form>

                    </div>

                </div>

            @endforeach

        </div>

        {{-- PAGINATION --}}
        <div class="mt-8">
            {{ $exercises->links() }}
        </div>

    </div>

</x-app-layout>