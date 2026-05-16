<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'GymControl Pro') }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- Material Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Alpine --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>

<body class="bg-zinc-950 text-white font-[Inter] selection:bg-emerald-500/30">

    <div class="min-h-screen">

        {{-- SIDEBAR --}}
        <x-sidebar :active="$active ?? ''" />

        {{-- MAIN CONTENT --}}
        <main class="md:ml-[280px] min-h-screen">

            {{-- TOPBAR --}}
            <x-topbar
                :title="$pageTitle ?? 'Dashboard'"
                :subtitle="$pageSubtitle ?? null"
                :showSearch="$showSearch ?? true"
            />

            {{-- CONTENT --}}
            <div class="px-4 md:px-8 py-6 md:py-8 pb-24">

                {{ $slot }}

            </div>

        </main>

        {{-- FAB --}}
        @isset($fab)
            <div class="fixed bottom-6 right-6 md:bottom-10 md:right-10 z-50">
                {{ $fab }}
            </div>
        @endisset

    </div>

    {{-- EXTRA SCRIPTS --}}
    @stack('scripts')

</body>

</html>