@props([
    'title' => Null,
    'subtitle' => null,
])

<header
    class="sticky top-0 z-40
           border-b border-white/5
           bg-[#121413]/80
           backdrop-blur-2xl"
>

    <div
        class="flex flex-col gap-4
               px-4 py-4
               md:flex-row md:items-center md:justify-between
               md:px-8 md:py-5"
    >

        {{-- LEFT --}}
        <div class="min-w-0">

            {{-- BREADCRUMB --}}
            <div class="flex items-center gap-2 text-xs tracking-[0.2em] uppercase">

                <span class="text-[#8b9290]">
                    GymControl
                </span>

                <span class="text-[#414846]">
                    /
                </span>

                <span class="text-[#aecdc5]">
                    {{ $title }}
                </span>

            </div>

            {{-- TITLE --}}
            <h1
                class="mt-2 text-2xl md:text-3xl
                       font-bold tracking-tight text-white
                       truncate"
            >
                {{ $title }}
            </h1>

            {{-- SUBTITLE --}}
            @if($subtitle)

                <p class="mt-1 text-sm text-[#8b9290]">

                    {{ $subtitle }}

                </p>

            @endif

        </div>

        {{-- RIGHT --}}
        <div class="w-full md:w-auto">

            {{-- SEARCH --}}
            <div class="relative w-full md:w-[320px]">

                <span
                    class="material-symbols-outlined
                           absolute left-4 top-1/2 -translate-y-1/2
                           text-[#8b9290]"
                >
                    search
                </span>

                <input
                    type="text"
                    placeholder="Buscar próximamente..."
                    disabled

                    class="
                        w-full rounded-2xl
                        border border-white/10
                        bg-white/5
                        py-3 pl-12 pr-4
                        text-sm text-white
                        placeholder:text-[#8b9290]
                        outline-none
                        transition-all

                        disabled:cursor-not-allowed
                        disabled:opacity-70

                        focus:border-[#aecdc5]
                        focus:ring
                        focus:ring-[#aecdc5]/20
                    "
                >

            </div>

        </div>

    </div>

</header>