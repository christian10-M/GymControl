<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Hola, {{ auth()->user()->name }}</h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto space-y-6 px-4">

        @if(session('success'))
            <div class="p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        {{-- Tarjetas resumen --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <div class="bg-white rounded-xl shadow p-5">
                <p class="text-sm text-gray-500">Membresía</p>
                @if($membership)
                    <p class="text-xl font-bold text-green-600 mt-1">Activa</p>
                    <p class="text-xs text-gray-400 mt-1">Vence: {{ $membership->end_date->format('d/m/Y') }}</p>
                @else
                    <p class="text-xl font-bold text-red-500 mt-1">Sin membresía</p>
                @endif
            </div>

            <div class="bg-white rounded-xl shadow p-5">
                <p class="text-sm text-gray-500">Asistencias este mes</p>
                <p class="text-3xl font-bold text-blue-600 mt-1">{{ $attendancesThisMonth }}</p>
                <p class="text-xs text-gray-400 mt-1">{{ now()->format('F Y') }}</p>
            </div>

            <div class="bg-white rounded-xl shadow p-5">
                <p class="text-sm text-gray-500">Rutina hoy</p>
                @if($todayRoutine)
                    <p class="text-xl font-bold text-purple-600 mt-1">Registrada ✓</p>
                    <p class="text-xs text-gray-400 mt-1">{{ $todayRoutine->routineExercises->count() }} ejercicio(s)</p>
                @else
                    <p class="text-xl font-bold text-gray-400 mt-1">Sin registrar</p>
                @endif
            </div>
        </div>

        {{-- Acciones rápidas --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            <a href="{{ route('routines.create') }}"
               class="bg-blue-600 text-white rounded-xl p-4 text-center hover:bg-blue-700">
                <div class="text-2xl mb-1">💪</div>
                <div class="text-sm font-medium">Registrar rutina</div>
            </a>
            <a href="{{ route('routines.index') }}"
               class="bg-white border rounded-xl p-4 text-center hover:bg-gray-50">
                <div class="text-2xl mb-1">📋</div>
                <div class="text-sm font-medium">Mis rutinas</div>
            </a>
            <a href="{{ route('exercises.index') }}"
               class="bg-white border rounded-xl p-4 text-center hover:bg-gray-50">
                <div class="text-2xl mb-1">🏋️</div>
                <div class="text-sm font-medium">Ejercicios</div>
            </a>
            <a href="{{ route('machines.index') }}"
               class="bg-white border rounded-xl p-4 text-center hover:bg-gray-50">
                <div class="text-2xl mb-1">⚙️</div>
                <div class="text-sm font-medium">Máquinas</div>
            </a>
        </div>

        {{-- Mis asistencias --}}
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="font-semibold text-gray-700 mb-4">Mis asistencias</h3>
            <div class="space-y-2">
                @forelse($attendances as $attendance)
                    <div class="flex items-center justify-between py-2 border-b last:border-0">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 rounded-full bg-green-500"></div>
                            <span class="font-medium">{{ $attendance->date->format('d/m/Y') }}</span>
                            <span class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($attendance->date)->locale('es')->dayName }}</span>
                        </div>
                        <span class="text-xs text-gray-400">{{ $attendance->time }}</span>
                    </div>
                @empty
                    <p class="text-gray-400 text-sm">Aún no hay asistencias registradas.</p>
                @endforelse
            </div>
            <div class="mt-4">{{ $attendances->links() }}</div>
        </div>

    </div>
</x-app-layout>