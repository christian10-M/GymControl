<x-app-layout>

    <x-slot name="header">

        <div>
            <h2 class="text-3xl font-black tracking-tight text-white">
                Mis Rutinas
            </h2>

            <p class="text-sm text-gray-400 mt-1">
                Historial completo de tus entrenamientos registrados
            </p>
        </div>

    </x-slot>

    <div class="p-4 md:p-8">

        <div class="max-w-6xl mx-auto">

            {{-- SUCCESS --}}
            @if(session('success'))

                <div
                    class="mb-6 rounded-3xl border border-emerald-500/20
                           bg-emerald-500/10 backdrop-blur-xl
                           p-4 text-sm text-emerald-300">

                    {{ session('success') }}

                </div>

            @endif

            {{-- TOP BAR --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

                <div>

                    <h3 class="text-xl font-bold text-white">
                        Historial de entrenamientos
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Consulta tus sesiones anteriores y progreso 💪
                    </p>

                </div>

                <a
                    href="{{ route('routines.create') }}"

                    class="inline-flex items-center justify-center gap-2
                           rounded-2xl bg-emerald-500 hover:bg-emerald-400
                           px-5 py-3 text-sm font-bold text-black
                           transition hover:scale-[1.02] active:scale-[0.98]">

                    <span class="material-symbols-outlined text-[20px]">
                        add
                    </span>

                    Registrar rutina

                </a>

            </div>

            {{-- ROUTINES --}}
            <div class="space-y-6">

                @forelse($routines as $routine)

                    <div
                        class="rounded-3xl border border-white/10
                               bg-white/5 backdrop-blur-xl
                               shadow-2xl shadow-black/20
                               overflow-hidden">

                        {{-- HEADER --}}
                        <div
                            class="flex flex-col md:flex-row md:items-center
                                   md:justify-between gap-4
                                   border-b border-white/5
                                   px-6 py-5">

                            <div>

                                <div class="flex items-center gap-3 flex-wrap">

                                    <h3 class="text-xl font-bold text-white">

                                        {{ $routine->date->format('d/m/Y') }}

                                    </h3>

                                    <span
                                        class="rounded-full border border-emerald-400/20
                                               bg-emerald-500/10
                                               px-3 py-1 text-xs font-semibold
                                               uppercase tracking-[0.15em]
                                               text-emerald-300">

                                        {{ $routine->date->locale('es')->dayName }}

                                    </span>

                                </div>

                                @if($routine->notes)

                                    <p class="mt-2 text-sm italic text-gray-400">
                                        "{{ $routine->notes }}"
                                    </p>

                                @endif

                            </div>

                            <div
                                class="flex items-center gap-2
                                       rounded-2xl border border-white/10
                                       bg-black/20 px-4 py-3">

                                <span class="material-symbols-outlined text-emerald-300">
                                    fitness_center
                                </span>

                                <div>

                                    <p class="text-xs uppercase tracking-[0.18em] text-gray-500">
                                        Ejercicios
                                    </p>

                                    <p class="text-lg font-bold text-white">
                                        {{ $routine->routineExercises->count() }}
                                    </p>

                                </div>

                            </div>

                        </div>

                        {{-- TABLE DESKTOP --}}
                        <div class="hidden md:block overflow-x-auto">

                            <table class="w-full">

                                <thead
                                    class="border-b border-white/5
                                           bg-black/10 text-left">

                                    <tr class="text-xs uppercase tracking-[0.15em] text-gray-500">

                                        <th class="px-6 py-4">Ejercicio</th>
                                        <th class="px-6 py-4">Músculo</th>
                                        <th class="px-6 py-4 text-center">Series</th>
                                        <th class="px-6 py-4 text-center">Reps</th>
                                        <th class="px-6 py-4 text-center">Peso</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach($routine->routineExercises as $item)

                                        <tr
                                            class="border-b border-white/5
                                                   transition hover:bg-white/[0.03]">

                                            <td class="px-6 py-4">

                                                <div>

                                                    <p class="font-semibold text-white">
                                                        {{ $item->exercise->name }}
                                                    </p>

                                                </div>

                                            </td>

                                            <td class="px-6 py-4 text-gray-400">

                                                {{ $item->exercise->muscle->name ?? '—' }}

                                            </td>

                                            <td class="px-6 py-4 text-center">

                                                <span
                                                    class="rounded-xl bg-white/5
                                                           px-3 py-1 text-sm text-white">

                                                    {{ $item->sets }}

                                                </span>

                                            </td>

                                            <td class="px-6 py-4 text-center">

                                                <span
                                                    class="rounded-xl bg-white/5
                                                           px-3 py-1 text-sm text-white">

                                                    {{ $item->reps }}

                                                </span>

                                            </td>

                                            <td class="px-6 py-4 text-center">

                                                <span
                                                    class="rounded-xl bg-emerald-500/10
                                                           px-3 py-1 text-sm font-semibold
                                                           text-emerald-300">

                                                    {{ $item->weight ? $item->weight . ' kg' : '—' }}

                                                </span>

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                        {{-- MOBILE CARDS --}}
                        <div class="md:hidden p-4 space-y-4">

                            @foreach($routine->routineExercises as $item)

                                <div
                                    class="rounded-2xl border border-white/10
                                           bg-black/20 p-4">

                                    <div class="flex items-start justify-between gap-3 mb-4">

                                        <div>

                                            <h4 class="font-bold text-white">
                                                {{ $item->exercise->name }}
                                            </h4>

                                            <p class="text-sm text-emerald-300 mt-1">
                                                {{ $item->exercise->muscle->name ?? 'Sin músculo' }}
                                            </p>

                                        </div>

                                        <span
                                            class="rounded-xl bg-emerald-500/10
                                                   px-3 py-1 text-xs font-semibold
                                                   text-emerald-300">

                                            {{ $item->weight ? $item->weight . ' kg' : '—' }}

                                        </span>

                                    </div>

                                    <div class="grid grid-cols-2 gap-3">

                                        <div
                                            class="rounded-2xl border border-white/5
                                                   bg-white/[0.03] p-3 text-center">

                                            <p class="text-xs uppercase tracking-[0.15em] text-gray-500">
                                                Series
                                            </p>

                                            <p class="mt-1 text-lg font-bold text-white">
                                                {{ $item->sets }}
                                            </p>

                                        </div>

                                        <div
                                            class="rounded-2xl border border-white/5
                                                   bg-white/[0.03] p-3 text-center">

                                            <p class="text-xs uppercase tracking-[0.15em] text-gray-500">
                                                Reps
                                            </p>

                                            <p class="mt-1 text-lg font-bold text-white">
                                                {{ $item->reps }}
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                @empty

                    {{-- EMPTY --}}
                    <div
                        class="rounded-3xl border border-dashed border-white/10
                               bg-white/5 p-12 text-center">

                        <div
                            class="mx-auto mb-6 flex h-24 w-24 items-center
                                   justify-center rounded-full bg-white/5">

                            <span class="material-symbols-outlined text-5xl text-gray-500">
                                exercise
                            </span>

                        </div>

                        <h3 class="text-2xl font-bold text-white mb-3">
                            Aún no tienes rutinas registradas
                        </h3>

                        <p class="max-w-md mx-auto text-gray-400">
                            Empieza a guardar tus entrenamientos para llevar
                            control de tu progreso dentro del gym.
                        </p>

                        <a
                            href="{{ route('routines.create') }}"

                            class="mt-8 inline-flex items-center gap-2
                                   rounded-2xl bg-emerald-500 hover:bg-emerald-400
                                   px-6 py-3 text-sm font-bold text-black
                                   transition hover:scale-[1.02]">

                            <span class="material-symbols-outlined">
                                add
                            </span>

                            Registrar primera rutina

                        </a>

                    </div>

                @endforelse

            </div>

            {{-- PAGINATION --}}
            @if($routines->hasPages())

                <div class="mt-10">

                    {{ $routines->links() }}

                </div>

            @endif

        </div>

    </div>

</x-app-layout>