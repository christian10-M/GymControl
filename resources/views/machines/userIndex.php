<x-app-layout
    pageTitle="Máquinas"
    pageSubtitle="Equipamiento disponible"
>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

    @foreach($machines as $machine)

        <div class="group rounded-3xl overflow-hidden
                    bg-white/5 border border-white/10
                    hover:border-emerald-400/30
                    transition duration-300">

            {{-- IMAGE --}}
            <div class="relative h-64 overflow-hidden">

                <img
                    src="{{ $machine->image }}"
                    alt="{{ $machine->name }}"
                    class="w-full h-full object-cover
                           group-hover:scale-110
                           transition duration-700"
                >

                <div class="absolute top-4 right-4">

                    @php
                        $statusColors = [
                            'available' => 'bg-emerald-500/90',
                            'maintenance' => 'bg-yellow-500/90',
                            'out_of_service' => 'bg-red-500/90',
                        ];
                    @endphp

                    <span class="px-3 py-1 rounded-full text-xs font-bold text-white
                        {{ $statusColors[$machine->status] ?? 'bg-gray-500' }}">

                        {{ str_replace('_', ' ', $machine->status) }}

                    </span>

                </div>

            </div>

            {{-- CONTENT --}}
            <div class="p-6 space-y-4">

                <div>

                    <h3 class="text-2xl font-black text-white">
                        {{ $machine->name }}
                    </h3>

                    <p class="text-emerald-300 text-sm mt-1">
                        {{ $machine->muscle->name }}
                    </p>

                </div>

                <p class="text-gray-400 text-sm leading-relaxed">
                    {{ $machine->description }}
                </p>

                <button
                    class="w-full rounded-2xl bg-emerald-500
                           hover:bg-emerald-400
                           py-3 font-bold text-black transition"
                >
                    Ver detalles
                </button>

            </div>

        </div>

    @endforeach

</div>

</x-app-layout>