<x-app-layout>

    <x-slot name="header">

        <div>

            <h1 class="text-3xl font-black text-white">
                Reportes
            </h1>

            <p class="text-gray-400 mt-2">
                Exportación y análisis del gimnasio
            </p>

        </div>

    </x-slot>

    <div class="p-4 md:p-8">

        <div class="grid gap-6 md:grid-cols-2">

            {{-- USERS REPORT --}}
            <a
                href="{{ route('reports.users') }}"
                class="group rounded-[32px]
                       border border-white/10
                       bg-white/5 backdrop-blur-xl
                       p-8 hover:bg-white/10 transition"
            >

                <div class="text-5xl mb-5">
                    👥
                </div>

                <h3 class="text-2xl font-black text-white">
                    Reporte de Usuarios
                </h3>

                <p class="text-gray-400 mt-3">
                    Exporta todos los miembros registrados del gimnasio.
                </p>

            </a>

            {{-- MEMBERSHIPS REPORT --}}
            <a
                href="{{ route('reports.memberships') }}"
                class="group rounded-[32px]
                       border border-white/10
                       bg-white/5 backdrop-blur-xl
                       p-8 hover:bg-white/10 transition"
            >

                <div class="text-5xl mb-5">
                    💳
                </div>

                <h3 class="text-2xl font-black text-white">
                    Reporte de Membresías
                </h3>

                <p class="text-gray-400 mt-3">
                    Consulta membresías activas y próximas a vencer.
                </p>

            </a>

        </div>

    </div>

</x-app-layout>