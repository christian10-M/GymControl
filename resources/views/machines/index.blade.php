<x-app-layout
    pageTitle="Máquinas"
    pageSubtitle="Gestión de equipamiento del gimnasio"
>

    <div class="space-y-6">

        {{-- SUCCESS --}}
        @if(session('success'))
            <div class="rounded-2xl border border-emerald-500/20
                        bg-emerald-500/10 text-emerald-300 px-5 py-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- TOPBAR --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>
                <h2 class="text-2xl font-black text-white">
                    Lista de máquinas
                </h2>

                <p class="text-gray-400 text-sm mt-1">
                    Administra todo el equipamiento
                </p>
            </div>

            {{-- SOLO ADMIN --}}
            @if(auth()->user()->role === 'admin')

                <a
                    href="{{ route('machines.create') }}"
                    class="inline-flex items-center justify-center gap-2
                           rounded-2xl bg-emerald-500 hover:bg-emerald-400
                           px-5 py-3 text-black font-bold transition"
                >
                    <span>+</span>
                    Nueva máquina
                </a>

            @endif

        </div>

        {{-- TABLE CARD --}}
        <div class="overflow-hidden rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl">

            {{-- DESKTOP TABLE --}}
            <div class="hidden md:block overflow-x-auto">

                <table class="w-full">

                    <thead class="border-b border-white/10 bg-white/5">

                        <tr class="text-left text-sm text-gray-400">

                            <th class="px-6 py-4">Máquina</th>
                            <th class="px-6 py-4">Músculo</th>
                            <th class="px-6 py-4">Estado</th>

                            @if(auth()->user()->role === 'admin')
                                <th class="px-6 py-4 text-right">Acciones</th>
                            @endif

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-white/5">

                        @foreach($machines as $machine)

                            <tr class="hover:bg-white/5 transition">

                                {{-- MACHINE --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-4">

                                        <img
                                            src="{{ $machine->image ?? 'https://placehold.co/200x200?text=Machine' }}"
                                            alt="{{ $machine->name }}"
                                            class="w-16 h-16 rounded-2xl object-cover border border-white/10"
                                            onerror="this.src='https://placehold.co/200x200?text=Machine'"
                                        >

                                        <div>

                                            <p class="font-semibold text-white">
                                                {{ $machine->name }}
                                            </p>

                                            <p class="text-sm text-gray-500">
                                                ID #{{ $machine->id }}
                                            </p>

                                        </div>

                                    </div>

                                </td>

                                {{-- MUSCLE --}}
                                <td class="px-6 py-5 text-gray-300">
                                    {{ $machine->muscle->name }}
                                </td>

                                {{-- STATUS --}}
                                <td class="px-6 py-5">

                                    @php
                                        $statusColors = [
                                            'available' => 'bg-emerald-500/10 text-emerald-300',
                                            'maintenance' => 'bg-yellow-500/10 text-yellow-300',
                                            'out_of_service' => 'bg-red-500/10 text-red-300',
                                        ];
                                    @endphp

                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $statusColors[$machine->status] ?? 'bg-white/10 text-white' }}">

                                        {{ str_replace('_', ' ', $machine->status) }}

                                    </span>

                                </td>

                                {{-- ACTIONS SOLO ADMIN --}}
                                @if(auth()->user()->role === 'admin')

                                    <td class="px-6 py-5">

                                        <div class="flex justify-end gap-3">

                                            <a
                                                href="{{ route('machines.edit', $machine) }}"
                                                class="px-4 py-2 rounded-xl bg-cyan-500/10
                                                       text-cyan-300 hover:bg-cyan-500/20 transition"
                                            >
                                                Editar
                                            </a>

                                            <form
                                                action="{{ route('machines.destroy', $machine) }}"
                                                method="POST"
                                                onsubmit="return confirm('¿Eliminar esta máquina?')"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    class="px-4 py-2 rounded-xl bg-red-500/10
                                                           text-red-300 hover:bg-red-500/20 transition"
                                                >
                                                    Eliminar
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                @endif

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            {{-- MOBILE CARDS --}}
            <div class="md:hidden divide-y divide-white/10">

                @foreach($machines as $machine)

                    <div class="p-5 space-y-4">

                        {{-- IMAGE --}}
                        <img
                            src="{{ $machine->image ?? 'https://placehold.co/600x400?text=Machine' }}"
                            alt="{{ $machine->name }}"
                            class="w-full h-48 object-cover rounded-2xl"
                            onerror="this.src='https://placehold.co/600x400?text=Machine'"
                        >

                        <div class="flex items-start justify-between gap-4">

                            <div>

                                <h3 class="font-bold text-white">
                                    {{ $machine->name }}
                                </h3>

                                <p class="text-sm text-gray-400 mt-1">
                                    {{ $machine->muscle->name }}
                                </p>

                            </div>

                            <span class="text-xs px-3 py-1 rounded-full bg-white/10 text-gray-300">
                                {{ str_replace('_', ' ', $machine->status) }}
                            </span>

                        </div>

                        {{-- ACTIONS SOLO ADMIN --}}
                        @if(auth()->user()->role === 'admin')

                            <div class="flex gap-3">

                                <a
                                    href="{{ route('machines.edit', $machine) }}"
                                    class="flex-1 text-center rounded-xl bg-cyan-500/10
                                           text-cyan-300 py-2"
                                >
                                    Editar
                                </a>

                                <form
                                    action="{{ route('machines.destroy', $machine) }}"
                                    method="POST"
                                    class="flex-1"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="w-full rounded-xl bg-red-500/10
                                               text-red-300 py-2"
                                    >
                                        Eliminar
                                    </button>

                                </form>

                            </div>

                        @endif

                    </div>

                @endforeach

            </div>

        </div>

        {{-- PAGINATION --}}
        <div>
            {{ $machines->links() }}
        </div>

    </div>

</x-app-layout>