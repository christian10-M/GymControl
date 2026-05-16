@props([
    'title' => 'Dashboard',
    'subtitle' => null,
])

<header class="sticky top-0 z-40 border-b border-zinc-800 bg-zinc-950/80 backdrop-blur-xl">

    <div class="flex h-20 items-center justify-between px-6 md:px-10">

        <div>

            <h1 class="text-2xl font-bold tracking-tight text-white">
                {{ $title }}
            </h1>

            @if($subtitle)
                <p class="text-sm text-zinc-400">
                    {{ $subtitle }}
                </p>
            @endif

        </div>

        <div class="hidden lg:flex items-center">

            <div class="relative">

                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-zinc-500">
                    search
                </span>

                <input
                    type="text"
                    placeholder="Buscar..."
                    class="w-80 rounded-xl border border-zinc-800 bg-zinc-900 py-3 pl-11 pr-4 text-sm text-white outline-none transition focus:border-emerald-400"
                >

            </div>

        </div>

    </div>

</header>