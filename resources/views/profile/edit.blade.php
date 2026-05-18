<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h1 class="text-3xl md:text-4xl font-black text-white">
                    Mi Perfil
                </h1>

                <p class="text-gray-400 mt-2">
                    Información personal y acceso del sistema
                </p>

            </div>

        </div>

    </x-slot>

    <div
        x-data="{ editing:false }"
        class="p-4 md:p-8"
    >

        <div class="max-w-5xl mx-auto">

            {{-- PROFILE CARD --}}
            <div
                class="rounded-[32px]
                       border border-white/10
                       bg-white/5 backdrop-blur-2xl
                       overflow-hidden shadow-2xl"
            >

                {{-- TOP --}}
                <div
                    class="relative border-b border-white/10
                           px-6 md:px-10 py-10"
                >

                    <div class="absolute inset-0
                                bg-gradient-to-r
                                from-cyan-500/10
                                via-emerald-500/5
                                to-transparent">
                    </div>

                    <div class="relative z-10 flex flex-col md:flex-row md:items-center gap-6">

                        {{-- AVATAR --}}
                        <div
                            class="w-28 h-28 rounded-3xl
                                   bg-emerald-500/15
                                   border border-emerald-400/20
                                   flex items-center justify-center
                                   text-5xl font-black text-emerald-300"
                        >

                            {{ strtoupper(substr(auth()->user()->name,0,1)) }}

                        </div>

                        {{-- INFO --}}
                        <div class="flex-1">

                            <h2 class="text-3xl font-black text-white">
                                {{ auth()->user()->name }}
                            </h2>

                            <p class="text-gray-400 mt-2">
                                {{ auth()->user()->email }}
                            </p>

                            <div class="flex flex-wrap gap-3 mt-5">

                                <div
                                    class="px-4 py-2 rounded-2xl
                                           bg-cyan-500/10
                                           border border-cyan-400/20
                                           text-cyan-300 text-sm font-medium"
                                >
                                    {{ auth()->user()->role === 'admin'
                                        ? 'Administrador'
                                        : 'Miembro'
                                    }}
                                </div>

                                <div
                                    class="px-4 py-2 rounded-2xl
                                           bg-emerald-500/10
                                           border border-emerald-400/20
                                           text-emerald-300 text-sm font-medium"
                                >
                                    Clave:
                                    {{ auth()->user()->access_key }}
                                </div>

                            </div>

                        </div>

                        {{-- BUTTON --}}
                        <button
                            @click="editing = !editing"
                            class="px-6 py-4 rounded-2xl
                                   bg-emerald-400 hover:bg-emerald-300
                                   text-black font-bold
                                   transition-all duration-200
                                   hover:scale-[1.02]"
                        >

                            <span x-show="!editing">
                                Editar perfil
                            </span>

                            <span x-show="editing">
                                Cancelar edición
                            </span>

                        </button>

                    </div>

                </div>

                {{-- INFO --}}
                <div class="p-6 md:p-10">

                    {{-- VIEW MODE --}}
                    <div
                        x-show="!editing"
                        x-transition
                        class="grid grid-cols-1 md:grid-cols-2 gap-6"
                    >

                        <div class="space-y-2">

                            <p class="text-sm text-gray-400">
                                Nombre completo
                            </p>

                            <div class="text-white text-lg font-semibold">
                                {{ auth()->user()->name }}
                            </div>

                        </div>

                        <div class="space-y-2">

                            <p class="text-sm text-gray-400">
                                Correo electrónico
                            </p>

                            <div class="text-white text-lg font-semibold">
                                {{ auth()->user()->email }}
                            </div>

                        </div>

                        <div class="space-y-2">

                            <p class="text-sm text-gray-400">
                                CURP
                            </p>

                            <div class="text-white text-lg font-semibold">
                                {{ auth()->user()->curp }}
                            </div>

                        </div>

                        <div class="space-y-2">

                            <p class="text-sm text-gray-400">
                                Edad
                            </p>

                            <div class="text-white text-lg font-semibold">
                                {{ auth()->user()->age }} años
                            </div>

                        </div>

                        <div class="space-y-2">

                            <p class="text-sm text-gray-400">
                                Género
                            </p>

                            <div class="text-white text-lg font-semibold capitalize">
                                {{ auth()->user()->gender }}
                            </div>

                        </div>

                    </div>

                    {{-- EDIT MODE --}}
                    <div
                        x-show="editing"
                        x-transition
                    >

                        @include('profile.partials.update-profile-information-form')

                    </div>

                </div>

            </div>

            {{-- PASSWORD ONLY ADMIN --}}
            @if(auth()->user()->role === 'admin')

                <div
                    class="mt-8 rounded-[32px]
                           border border-white/10
                           bg-white/5 backdrop-blur-2xl
                           overflow-hidden shadow-2xl"
                >

                    <div class="px-6 md:px-10 py-8 border-b border-white/10">

                        <h2 class="text-2xl font-black text-white">
                            Seguridad
                        </h2>

                        <p class="text-gray-400 mt-2">
                            Cambia tu contraseña de administrador
                        </p>

                    </div>

                    <div class="p-6 md:p-10">

                        @include('profile.partials.update-password-form')

                    </div>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>