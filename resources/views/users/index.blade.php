<x-app-layout>

    <x-slot name="header">
        <div>
            <h1 class="text-3xl md:text-4xl font-black text-white">
                Usuarios
            </h1>

            <p class="text-gray-400 mt-2">
                Administración de miembros del gimnasio
            </p>
        </div>
    </x-slot>

    <div class="p-4 md:p-8">

        {{-- TOP BAR --}}
        <div class="flex flex-col md:flex-row gap-4 md:items-center md:justify-between mb-8">

            <div class="relative w-full md:max-w-md">

                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
                    search
                </span>

                <input
                    type="text"
                    placeholder="Buscar usuarios..."
                    class="w-full rounded-2xl border border-white/10 bg-white/5
                           py-4 pl-12 pr-4 text-white placeholder-gray-500
                           focus:border-emerald-400 focus:ring focus:ring-emerald-400/20"
                >

            </div>

            <a
                href="{{ route('users.create') }}"
                class="rounded-2xl bg-emerald-400 px-6 py-4 text-sm font-bold text-black
                       hover:bg-emerald-300 transition text-center"
            >
                + Nuevo miembro
            </a>

        </div>

        {{-- TABLE --}}
        <div class="overflow-hidden rounded-[32px] border border-white/10 bg-white/5 backdrop-blur-xl">

            <div class="overflow-x-auto">

                <table class="w-full min-w-[800px]">

                    <thead class="border-b border-white/10 bg-white/5">

                        <tr class="text-left text-sm text-gray-400">

                            <th class="px-6 py-5">Usuario</th>
                            <th class="px-6 py-5">Correo</th>
                            <th class="px-6 py-5">Membresía</th>
                            <th class="px-6 py-5">Estado</th>
                            <th class="px-6 py-5 text-right">Acciones</th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-white/5">

                        @forelse($users as $user)

                            <tr class="hover:bg-white/5 transition">

                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-4">

                                        <div
                                            class="w-12 h-12 rounded-full
                                                   bg-emerald-400/15 text-emerald-300
                                                   flex items-center justify-center
                                                   font-bold"
                                        >
                                            {{ strtoupper(substr($user->name,0,1)) }}
                                        </div>

                                        <div>

                                            <p class="font-semibold text-white">
                                                {{ $user->name }}
                                            </p>

                                            <p class="text-xs text-gray-500">
                                                {{ $user->access_key }}
                                            </p>

                                        </div>

                                    </div>

                                </td>

                                <td class="px-6 py-5 text-gray-300">
                                    {{ $user->email }}
                                </td>

                                <td class="px-6 py-5 text-gray-300">
                                    {{ $user->activeMembership?->type ?? 'Sin membresía' }}
                                </td>

                                <td class="px-6 py-5">

                                    @if($user->activeMembership)

                                        <span class="px-3 py-1 rounded-full text-xs
                                                     bg-emerald-500/15 text-emerald-300">
                                            Activa
                                        </span>

                                    @else

                                        <span class="px-3 py-1 rounded-full text-xs
                                                     bg-red-500/15 text-red-300">
                                            Inactiva
                                        </span>

                                    @endif

                                </td>

                                <td class="px-6 py-5">

                                    <div class="flex justify-end gap-3">

                                        <a
                                            href="{{ route('users.edit', $user) }}"
                                            class="text-cyan-400 hover:text-cyan-300"
                                        >
                                            Editar
                                        </a>

                                        <form
                                            action="{{ route('users.destroy', $user) }}"
                                            method="POST"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                class="text-red-400 hover:text-red-300"
                                            >
                                                Eliminar
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="px-6 py-20 text-center text-gray-500">

                                    No hay usuarios registrados

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="mt-8">
            {{ $users->links() }}
        </div>

    </div>

</x-app-layout>