<x-app-layout>

    <div class="px-4 md:px-8 py-6 space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>
                <h1 class="text-3xl md:text-4xl font-black text-white">
                    Músculos
                </h1>

                <p class="text-gray-400 mt-2">
                    Gestiona todos los grupos musculares del gimnasio.
                </p>
            </div>

            <a href="{{ route('muscles.create') }}"
               class="inline-flex items-center justify-center gap-2
                      rounded-2xl bg-emerald-500 hover:bg-emerald-400
                      px-5 py-3 text-black font-bold transition">
                <span>＋</span>
                Nuevo músculo
            </a>

        </div>

        {{-- SUCCESS --}}
        @if(session('success'))
            <div class="rounded-2xl border border-emerald-500/20
                        bg-emerald-500/10 text-emerald-300
                        px-4 py-3">
                {{ session('success') }}
            </div>
        @endif

        {{-- TABLET / DESKTOP TABLE --}}
        <div class="hidden md:block overflow-hidden rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl">

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="border-b border-white/10 bg-white/5">

                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">
                                Nombre
                            </th>

                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">
                                Parte del cuerpo
                            </th>

                            <th class="px-6 py-4 text-right text-sm font-semibold text-gray-300">
                                Acciones
                            </th>
                        </tr>

                    </thead>

                    <tbody class="divide-y divide-white/5">

                        @forelse($muscles as $muscle)

                            <tr class="hover:bg-white/5 transition">

                                <td class="px-6 py-5 text-white font-medium">
                                    {{ $muscle->name }}
                                </td>

                                <td class="px-6 py-5 text-gray-400">
                                    {{ $muscle->body_part ?? '—' }}
                                </td>

                                <td class="px-6 py-5">

                                    <div class="flex justify-end gap-3">

                                        <a href="{{ route('muscles.edit', $muscle) }}"
                                           class="rounded-xl bg-cyan-500/10 hover:bg-cyan-500/20
                                                  text-cyan-300 px-4 py-2 text-sm transition">
                                            Editar
                                        </a>

                                        <form action="{{ route('muscles.destroy', $muscle) }}"
                                              method="POST"
                                              onsubmit="return confirm('¿Eliminar este músculo?')">
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                class="rounded-xl bg-red-500/10 hover:bg-red-500/20
                                                       text-red-300 px-4 py-2 text-sm transition">
                                                Eliminar
                                            </button>
                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="3" class="px-6 py-16 text-center text-gray-500">
                                    No hay músculos registrados 🧬
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        {{-- MOBILE CARDS --}}
        <div class="grid grid-cols-1 gap-4 md:hidden">

            @forelse($muscles as $muscle)

                <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-5">

                    <div class="flex items-start justify-between gap-4">

                        <div>

                            <h3 class="text-lg font-bold text-white">
                                {{ $muscle->name }}
                            </h3>

                            <p class="text-sm text-gray-400 mt-1">
                                {{ $muscle->body_part ?? 'Sin categoría' }}
                            </p>

                        </div>

                    </div>

                    <div class="flex gap-3 mt-5">

                        <a href="{{ route('muscles.edit', $muscle) }}"
                           class="flex-1 text-center rounded-2xl bg-cyan-500/10
                                  text-cyan-300 py-2.5">
                            Editar
                        </a>

                        <form action="{{ route('muscles.destroy', $muscle) }}"
                              method="POST"
                              class="flex-1"
                              onsubmit="return confirm('¿Eliminar este músculo?')">
                            @csrf
                            @method('DELETE')

                            <button
                                class="w-full rounded-2xl bg-red-500/10
                                       text-red-300 py-2.5">
                                Eliminar
                            </button>
                        </form>

                    </div>

                </div>

            @empty

                <div class="rounded-3xl border border-white/10 bg-white/5 p-10 text-center text-gray-500">
                    No hay músculos registrados 🧬
                </div>

            @endforelse

        </div>

        {{-- PAGINATION --}}
        <div>
            {{ $muscles->links() }}
        </div>

    </div>

</x-app-layout>