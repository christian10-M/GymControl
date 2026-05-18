<x-app-layout>

    <x-slot name="header">
        <div>
            <h1 class="text-3xl font-black text-white">
                Membresías
            </h1>

            <p class="text-gray-400 mt-2">
                Control de membresías activas e inactivas
            </p>
        </div>
    </x-slot>

    <div class="p-4 md:p-8">

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">

            @foreach($memberships as $membership)

                <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-6">

                    <div class="flex items-center justify-between mb-6">

                        <div>

                            <h3 class="text-xl font-bold text-white">
                                {{ $membership->user->name }}
                            </h3>

                            <p class="text-sm text-gray-400 mt-1">
                                {{ $membership->type }}
                            </p>

                        </div>

                        <div
                            class="w-14 h-14 rounded-2xl
                                   bg-emerald-500/15
                                   flex items-center justify-center"
                        >
                            👑
                        </div>

                    </div>

                    <div class="space-y-3 text-sm">

                        <div class="flex justify-between">

                            <span class="text-gray-400">
                                Inicio
                            </span>

                            <span class="text-white">
                                {{ $membership->start_date }}
                            </span>

                        </div>

                        <div class="flex justify-between">

                            <span class="text-gray-400">
                                Fin
                            </span>

                            <span class="text-white">
                                {{ $membership->end_date }}
                            </span>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</x-app-layout>