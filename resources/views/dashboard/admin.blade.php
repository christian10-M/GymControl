<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-2">

            <h1 class="text-3xl md:text-4xl font-black tracking-tight text-white">
                Admin Dashboard
            </h1>

            <p class="text-gray-400">
                Control total del gimnasio y métricas generales
            </p>

        </div>
    </x-slot>

    <div class="p-4 md:p-8 space-y-8">

        {{-- HERO --}}
        <section
            class="relative overflow-hidden rounded-[32px]
                   border border-white/10
                   bg-gradient-to-br from-emerald-500/10 via-cyan-500/5 to-transparent
                   backdrop-blur-2xl p-6 md:p-10">

            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(16,185,129,0.18),transparent_35%)]"></div>

            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">

                <div class="max-w-2xl">


                    <h2 class="text-4xl md:text-5xl font-black leading-tight text-white">
                        Bienvenido,
                        <span class="text-emerald-400">
                            {{ auth()->user()->name }}
                        </span>
                    </h2>

                    <p class="mt-4 text-gray-400 text-lg leading-relaxed">
                        Gestiona ejercicios, músculos, máquinas y usuarios desde un único panel elegante y moderno.
                    </p>

                </div>

                {{-- QUICK ACTIONS --}}
                <div class="grid grid-cols-2 gap-4 w-full lg:w-auto">

                    <a href="{{ route('exercises.create') }}"
                       class="group rounded-3xl border border-white/10 bg-white/5 p-5 hover:bg-white/10 transition">

                        <div class="text-3xl mb-4">🏋️</div>

                        <h3 class="font-bold text-white">
                            Nuevo Ejercicio
                        </h3>

                        <p class="text-sm text-gray-400 mt-1">
                            Crear ejercicios
                        </p>

                    </a>

                    <a href="{{ route('muscles.create') }}"
                       class="group rounded-3xl border border-white/10 bg-white/5 p-5 hover:bg-white/10 transition">

                        <div class="text-3xl mb-4">💪</div>

                        <h3 class="font-bold text-white">
                            Nuevo Músculo
                        </h3>

                        <p class="text-sm text-gray-400 mt-1">
                            Agregar grupos
                        </p>

                    </a>

                    <a href="{{ route('machines.create') }}"
                       class="group rounded-3xl border border-white/10 bg-white/5 p-5 hover:bg-white/10 transition">

                        <div class="text-3xl mb-4">⚙️</div>

                        <h3 class="font-bold text-white">
                            Nueva Máquina
                        </h3>

                        <p class="text-sm text-gray-400 mt-1">
                            Equipamiento
                        </p>

                    </a>

                    <a href="{{ route('exercises.index') }}"
                       class="group rounded-3xl border border-white/10 bg-white/5 p-5 hover:bg-white/10 transition">

                        <div class="text-3xl mb-4">📚</div>

                        <h3 class="font-bold text-white">
                            Biblioteca
                        </h3>

                        <p class="text-sm text-gray-400 mt-1">
                            Ver ejercicios
                        </p>

                    </a>

                </div>

            </div>

        </section>

        {{-- STATS --}}
        <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

            {{-- CARD --}}
            <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-6">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-400 text-sm">
                            Ejercicios
                        </p>

                        <h3 class="text-4xl font-black text-white mt-2">
                            {{ $totalExercises }}
                        </h3>

                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-emerald-500/15 flex items-center justify-center text-2xl">
                        🏋️
                    </div>

                </div>

            </div>

            {{-- CARD --}}
            <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-6">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-400 text-sm">
                            Músculos
                        </p>

                        <h3 class="text-4xl font-black text-white mt-2">
                            {{ $totalMuscles }}
                        </h3>

                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-cyan-500/15 flex items-center justify-center text-2xl">
                        💪
                    </div>

                </div>

            </div>

            {{-- CARD --}}
            <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-6">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-400 text-sm">
                            Máquinas
                        </p>

                        <h3 class="text-4xl font-black text-white mt-2">
                            {{ $totalMachines }}
                        </h3>

                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-orange-500/15 flex items-center justify-center text-2xl">
                        ⚙️
                    </div>

                </div>

            </div>

            {{-- CARD --}}
            <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-6">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-400 text-sm">
                            Usuarios
                        </p>

                        <h3 class="text-4xl font-black text-white mt-2">
                            {{ $totalUsers }}
                        </h3>

                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-pink-500/15 flex items-center justify-center text-2xl">
                        👥
                    </div>

                </div>

            </div>

        </section>

        {{-- CONTENT GRID --}}
        <section class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- LEFT --}}
            <div class="xl:col-span-2 space-y-6">

                {{-- RECENT EXERCISES --}}
                <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl overflow-hidden">

                    <div class="p-6 border-b border-white/10">

                        <div class="flex items-center justify-between">

                            <div>

                                <h3 class="text-xl font-bold text-white">
                                    Últimos ejercicios
                                </h3>

                                <p class="text-gray-400 text-sm mt-1">
                                    Ejercicios recientemente agregados
                                </p>

                            </div>

                            <a href="{{ route('exercises.index') }}"
                               class="text-emerald-400 hover:text-emerald-300 text-sm font-medium">
                                Ver todos
                            </a>

                        </div>

                    </div>

                    <div class="divide-y divide-white/5">

                        @forelse($latestExercises as $exercise)

                            <div class="p-5 flex items-center justify-between hover:bg-white/5 transition">

                                <div>

                                    <h4 class="font-semibold text-white">
                                        {{ $exercise->name }}
                                    </h4>

                                    <p class="text-sm text-gray-400 mt-1">
                                        {{ $exercise->muscle->name }}
                                    </p>

                                </div>

                                <span class="px-3 py-1 rounded-full text-xs bg-white/10 text-gray-300">
                                    {{ $exercise->difficulty ?? 'N/A' }}
                                </span>

                            </div>

                        @empty

                            <div class="p-10 text-center text-gray-500">
                                No hay ejercicios registrados
                            </div>

                        @endforelse

                    </div>

                </div>

            </div>

            {{-- RIGHT --}}
            <div class="space-y-6">

                {{-- SYSTEM STATUS --}}
                <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-6">

                    <h3 class="text-xl font-bold text-white mb-6">
                        Estado del sistema
                    </h3>

                    <div class="space-y-5">

                        <div class="flex items-center justify-between">

                            <span class="text-gray-400">
                                Base de datos
                            </span>

                            <span class="text-emerald-400 font-semibold">
                                Online
                            </span>

                        </div>

                        <div class="flex items-center justify-between">

                            <span class="text-gray-400">
                                Panel Admin
                            </span>

                            <span class="text-emerald-400 font-semibold">
                                Activo
                            </span>

                        </div>

                        <div class="flex items-center justify-between">

                            <span class="text-gray-400">
                                Último acceso
                            </span>

                            <span class="text-white font-medium">
                                Hoy
                            </span>

                        </div>

                    </div>

                </div>

                {{-- ADMIN PROFILE --}}
                <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-6">

                    <div class="flex flex-col items-center text-center">

                        <div class="w-24 h-24 rounded-full bg-emerald-500/20 border border-emerald-400/20
                                    flex items-center justify-center text-4xl font-black text-emerald-300">

                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                        </div>

                        <h3 class="text-xl font-bold text-white mt-5">
                            {{ auth()->user()->name }}
                        </h3>

                        <p class="text-emerald-400 text-sm uppercase tracking-widest mt-1">
                            Administrador
                        </p>

                    </div>

                </div>

            </div>

        </section>

    </div>

</x-app-layout>