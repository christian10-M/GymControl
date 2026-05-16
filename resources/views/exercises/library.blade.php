<x-app-layout>

    <x-slot name="header">

        <div>
            <h2 class="text-3xl font-bold text-white">
                Biblioteca de Ejercicios
            </h2>

            <p class="text-gray-400 mt-1">
                Explora ejercicios disponibles para tus rutinas
            </p>
        </div>

    </x-slot>

    <div class="p-4 md:p-8">

        {{-- GRID --}}
        <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">

            @forelse($exercises as $exercise)

                <div
                    class="group rounded-3xl border border-white/10
                           bg-white/5 backdrop-blur-xl
                           p-6 transition-all duration-300
                           hover:border-emerald-400/30
                           hover:bg-white/[0.07]
                           hover:shadow-2xl hover:shadow-emerald-500/10">

                    {{-- HEADER --}}
                    <div class="flex items-start justify-between mb-5">

                        <div>

                            <h3 class="text-xl font-bold text-white">
                                {{ $exercise->name }}
                            </h3>

                            <p class="text-sm text-emerald-300 mt-1">
                                {{ $exercise->muscle->name ?? 'Sin músculo' }}
                            </p>

                        </div>

                        {{-- DIFFICULTY --}}
                        @if($exercise->difficulty)

                            <span
                                class="px-3 py-1 rounded-full text-xs font-semibold
                                       border border-white/10
                                       bg-black/20 text-gray-300">

                                {{ ucfirst($exercise->difficulty) }}

                            </span>

                        @endif

                    </div>

                    {{-- DESCRIPTION --}}
                    <div class="mb-6">

                        <p class="text-sm leading-relaxed text-gray-400">

                            {{ $exercise->description
                                ? Str::limit($exercise->description, 120)
                                : 'Sin descripción disponible.' }}

                        </p>

                    </div>

                    {{-- MACHINE --}}
                    <div
                        class="mb-6 rounded-2xl
                               border border-white/5
                               bg-black/20
                               p-4">

                        <div class="flex items-center gap-2 mb-2">

                            <span class="material-symbols-outlined text-[20px] text-emerald-300">
                                precision_manufacturing
                            </span>

                            <p class="text-sm font-semibold text-white">
                                Máquina recomendada
                            </p>

                        </div>

                        @php
                            $machine = \App\Models\Machine::where('muscle_id', $exercise->muscle_id)->first();
                        @endphp

                        @if($machine)

                            <div class="flex items-center justify-between">

                                <div>

                                    <p class="text-sm text-gray-200 font-medium">
                                        {{ $machine->name }}
                                    </p>

                                    

                                </div>

                                <span
                                    class="px-3 py-1 rounded-full text-xs
                                           bg-emerald-500/10
                                           text-emerald-300
                                           border border-emerald-500/10">

                                   <p class="text-xs text-gray-500 mt-1">
                                        Estado:
                                        {{ ucfirst(str_replace('_', ' ', $machine->status)) }}
                                    </p>

                                </span>

                            </div>

                        @else

                            <p class="text-sm text-gray-500">
                                No hay máquina relacionada.
                            </p>

                        @endif

                    </div>

                    {{-- FOOTER --}}
                    <div
                        class="pt-4 border-t border-white/5
                               flex items-center gap-2 text-gray-500 text-sm">

                        <span class="material-symbols-outlined text-[18px]">
                            fitness_center
                        </span>

                        Ejercicio listo para agregar a rutina

                    </div>

                </div>

            @empty

                {{-- EMPTY --}}
                <div
                    class="col-span-full rounded-3xl border border-dashed border-white/10
                           bg-white/5 p-12 text-center">

                    <div
                        class="mx-auto mb-5 w-20 h-20 rounded-full
                               bg-white/5 flex items-center justify-center">

                        <span class="material-symbols-outlined text-4xl text-gray-500">
                            exercise
                        </span>

                    </div>

                    <h3 class="text-xl font-bold text-white mb-2">
                        No hay ejercicios disponibles
                    </h3>

                    <p class="text-gray-400">
                        El administrador aún no ha registrado ejercicios.
                    </p>

                </div>

            @endforelse

        </div>

        {{-- PAGINATION --}}
        @if($exercises->hasPages())

            <div class="mt-10">

                {{ $exercises->links() }}

            </div>

        @endif

    </div>

</x-app-layout>