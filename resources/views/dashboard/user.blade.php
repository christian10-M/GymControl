<x-app-layout>

    <x-slot name="header">

        <div>

            <h2 class="text-3xl font-black tracking-tight text-white">
                Hola, {{ auth()->user()->name }} 👋
            </h2>

            <p class="text-sm text-gray-400 mt-1">
                Bienvenido de nuevo a GymControl Pro
            </p>

        </div>

    </x-slot>

    <div class="p-4 md:p-8">

        <div class="max-w-7xl mx-auto space-y-8">

            {{-- SUCCESS --}}
            @if(session('success'))

                <div
                    class="rounded-3xl border border-emerald-500/20
                           bg-emerald-500/10 backdrop-blur-xl
                           p-4 text-sm text-emerald-300">

                    {{ session('success') }}

                </div>

            @endif

            {{-- HERO --}}
            <div
                class="relative overflow-hidden rounded-[32px]
                       border border-white/10
                       bg-gradient-to-br from-emerald-500/20
                       via-black/40 to-cyan-500/10
                       backdrop-blur-2xl p-8 md:p-10">

                {{-- GLOW --}}
                <div
                    class="absolute -top-20 -right-20 h-60 w-60
                           rounded-full bg-emerald-400/10 blur-3xl">
                </div>

                <div class="relative z-10">

                    <div
                        class="inline-flex items-center gap-2
                               rounded-full border border-emerald-400/20
                               bg-emerald-500/10 px-4 py-2
                               text-xs font-semibold uppercase tracking-[0.2em]
                               text-emerald-300">

                        <span class="material-symbols-outlined text-[18px]">
                            monitoring
                        </span>

                        Panel del usuario

                    </div>

                    <h1
                        class="mt-5 text-4xl md:text-5xl
                               font-black leading-tight tracking-tight text-white">

                        Sigue construyendo
                        <span class="text-emerald-300">
                            tu progreso
                        </span>

                    </h1>

                    <p class="mt-4 max-w-2xl text-gray-300 leading-relaxed">

                        Consulta tus asistencias, registra rutinas
                        y explora ejercicios para mantener tu avance
                        dentro del gimnasio.

                    </p>

                </div>

            </div>

            {{-- STATS --}}
            <div class="grid gap-6 md:grid-cols-3">

                {{-- MEMBERSHIP --}}
                <div
                    class="rounded-3xl border border-white/10
                           bg-white/5 backdrop-blur-xl p-6">

                    <div class="flex items-center justify-between mb-5">

                        <div>

                            <p class="text-sm uppercase tracking-[0.15em] text-gray-500">
                                Membresía
                            </p>

                            @if($membership)

                                <h3 class="mt-2 text-3xl font-black text-emerald-300">
                                    Activa
                                </h3>

                            @else

                                <h3 class="mt-2 text-3xl font-black text-red-400">
                                    Inactiva
                                </h3>

                            @endif

                        </div>

                        <div
                            class="flex h-14 w-14 items-center justify-center
                                   rounded-2xl bg-emerald-500/10">

                            <span class="material-symbols-outlined text-emerald-300 text-3xl">
                                workspace_premium
                            </span>

                        </div>

                    </div>

                    @if($membership)

                        <p class="text-sm text-gray-400">
                            Vence:
                            <span class="text-white font-medium">
                                {{ $membership->end_date->format('d/m/Y') }}
                            </span>
                        </p>

                    @else

                        <p class="text-sm text-gray-500">
                            No hay membresía registrada.
                        </p>

                    @endif

                </div>

                {{-- ATTENDANCES --}}
                <div
                    class="rounded-3xl border border-white/10
                           bg-white/5 backdrop-blur-xl p-6">

                    <div class="flex items-center justify-between mb-5">

                        <div>

                            <p class="text-sm uppercase tracking-[0.15em] text-gray-500">
                                Asistencias
                            </p>

                            <h3 class="mt-2 text-4xl font-black text-cyan-300">
                                {{ $attendancesThisMonth }}
                            </h3>

                        </div>

                        <div
                            class="flex h-14 w-14 items-center justify-center
                                   rounded-2xl bg-cyan-500/10">

                            <span class="material-symbols-outlined text-cyan-300 text-3xl">
                                calendar_month
                            </span>

                        </div>

                    </div>

                    <p class="text-sm text-gray-400">
                        {{ now()->locale('es')->translatedFormat('F Y') }}
                    </p>

                </div>

                {{-- ROUTINE --}}
                <div
                    class="rounded-3xl border border-white/10
                           bg-white/5 backdrop-blur-xl p-6">

                    <div class="flex items-center justify-between mb-5">

                        <div>

                            <p class="text-sm uppercase tracking-[0.15em] text-gray-500">
                                Rutina de hoy
                            </p>

                            @if($todayRoutine)

                                <h3 class="mt-2 text-3xl font-black text-violet-300">
                                    Registrada
                                </h3>

                            @else

                                <h3 class="mt-2 text-3xl font-black text-gray-400">
                                    Pendiente
                                </h3>

                            @endif

                        </div>

                        <div
                            class="flex h-14 w-14 items-center justify-center
                                   rounded-2xl bg-violet-500/10">

                            <span class="material-symbols-outlined text-violet-300 text-3xl">
                                fitness_center
                            </span>

                        </div>

                    </div>

                    @if($todayRoutine)

                        <p class="text-sm text-gray-400">
                            {{ $todayRoutine->routineExercises->count() }}
                            ejercicio(s) registrados.
                        </p>

                    @else

                        <p class="text-sm text-gray-500">
                            Aún no registras entrenamiento hoy.
                        </p>

                    @endif

                </div>

            </div>

            {{-- QUICK ACTIONS --}}
            <div>

                <div class="mb-5">

                    <h3 class="text-2xl font-bold text-white">
                        Acciones rápidas
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Todo listo para tu próxima sesión ⚡
                    </p>

                </div>

                <div class="grid gap-4 grid-cols-2 xl:grid-cols-4">

                    {{-- REGISTER --}}
                    <a
                        href="{{ route('routines.create') }}"

                        class="group rounded-3xl border border-emerald-400/20
                               bg-emerald-500/10 p-6 transition
                               hover:scale-[1.02] hover:bg-emerald-500/20">

                        <div
                            class="mb-5 flex h-14 w-14 items-center justify-center
                                   rounded-2xl bg-emerald-500/20">

                            <span class="material-symbols-outlined text-3xl text-emerald-300">
                                add_task
                            </span>

                        </div>

                        <h4 class="font-bold text-white">
                            Registrar rutina
                        </h4>

                        <p class="mt-2 text-sm text-emerald-200/80">
                            Guarda tu entrenamiento de hoy.
                        </p>

                    </a>

                    {{-- ROUTINES --}}
                    <a
                        href="{{ route('routines.index') }}"

                        class="group rounded-3xl border border-white/10
                               bg-white/5 p-6 transition
                               hover:scale-[1.02] hover:bg-white/[0.08]">

                        <div
                            class="mb-5 flex h-14 w-14 items-center justify-center
                                   rounded-2xl bg-white/5">

                            <span class="material-symbols-outlined text-3xl text-cyan-300">
                                list_alt
                            </span>

                        </div>

                        <h4 class="font-bold text-white">
                            Mis rutinas
                        </h4>

                        <p class="mt-2 text-sm text-gray-400">
                            Consulta tu historial completo.
                        </p>

                    </a>

                    {{-- EXERCISES --}}
                    <a
                        href="{{ route('exercises.library') }}"

                        class="group rounded-3xl border border-white/10
                               bg-white/5 p-6 transition
                               hover:scale-[1.02] hover:bg-white/[0.08]">

                        <div
                            class="mb-5 flex h-14 w-14 items-center justify-center
                                   rounded-2xl bg-white/5">

                            <span class="material-symbols-outlined text-3xl text-violet-300">
                                exercise
                            </span>

                        </div>

                        <h4 class="font-bold text-white">
                            Biblioteca
                        </h4>

                        <p class="mt-2 text-sm text-gray-400">
                            Descubre ejercicios disponibles.
                        </p>

                    </a>

                    {{-- MACHINES --}}
                    <a
                        href="{{ route('machines.index') }}"

                        class="group rounded-3xl border border-white/10
                               bg-white/5 p-6 transition
                               hover:scale-[1.02] hover:bg-white/[0.08]">

                        <div
                            class="mb-5 flex h-14 w-14 items-center justify-center
                                   rounded-2xl bg-white/5">

                            <span class="material-symbols-outlined text-3xl text-orange-300">
                                precision_manufacturing
                            </span>

                        </div>

                        <h4 class="font-bold text-white">
                            Máquinas
                        </h4>

                        <p class="mt-2 text-sm text-gray-400">
                            Consulta máquinas del gym.
                        </p>

                    </a>

                </div>

            </div>

            {{-- ATTENDANCES --}}
            <div
                class="rounded-[32px] border border-white/10
                       bg-white/5 backdrop-blur-xl p-6 md:p-8">

                <div class="flex items-center justify-between mb-8">

                    <div>

                        <h3 class="text-2xl font-bold text-white">
                            Mis asistencias
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Registro automático de entradas al gimnasio
                        </p>

                    </div>

                    <div
                        class="hidden md:flex items-center gap-2
                               rounded-2xl border border-white/10
                               bg-black/20 px-4 py-3">

                        <span class="material-symbols-outlined text-emerald-300">
                            verified
                        </span>

                        <span class="text-sm text-white font-medium">
                            Sistema activo
                        </span>

                    </div>

                </div>

                <div class="space-y-3">

                    @forelse($attendances as $attendance)

                        <div
                            class="flex items-center justify-between
                                   rounded-2xl border border-white/5
                                   bg-black/20 px-5 py-4
                                   transition hover:bg-white/[0.03]">

                            <div class="flex items-center gap-4">

                                <div
                                    class="flex h-11 w-11 items-center justify-center
                                           rounded-2xl bg-emerald-500/10">

                                    <span class="material-symbols-outlined text-emerald-300">
                                        check
                                    </span>

                                </div>

                                <div>

                                    <p class="font-semibold text-white">

                                        {{ $attendance->date->format('d/m/Y') }}

                                    </p>

                                    <p class="text-xs uppercase tracking-[0.15em] text-gray-500">

                                        {{ \Carbon\Carbon::parse($attendance->date)->locale('es')->dayName }}

                                    </p>

                                </div>

                            </div>

                            <div class="text-right">

                                <p class="text-sm font-semibold text-cyan-300">
                                    {{ $attendance->time }}
                                </p>

                                <p class="text-xs text-gray-500">
                                    Hora registrada
                                </p>

                            </div>

                        </div>

                    @empty

                        <div
                            class="rounded-3xl border border-dashed border-white/10
                                   bg-black/20 p-12 text-center">

                            <div
                                class="mx-auto mb-5 flex h-20 w-20 items-center
                                       justify-center rounded-full bg-white/5">

                                <span class="material-symbols-outlined text-5xl text-gray-500">
                                    calendar_month
                                </span>

                            </div>

                            <h3 class="text-xl font-bold text-white mb-2">
                                Sin asistencias registradas
                            </h3>

                            <p class="text-gray-400">
                                Tus accesos al gimnasio aparecerán aquí.
                            </p>

                        </div>

                    @endforelse

                </div>

                {{-- PAGINATION --}}
                @if($attendances->hasPages())

                    <div class="mt-8">

                        {{ $attendances->links() }}

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>