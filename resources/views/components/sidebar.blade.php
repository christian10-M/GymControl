@props(['active' => ''])

@php
    $user = auth()->user();
    $isAdmin = $user && $user->role === 'admin';

    $navigation = [

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */

        [
            'name' => 'Dashboard',
            'route' => $isAdmin ? 'admin.dashboard' : 'user.dashboard',
            'icon' => 'dashboard',
            'roles' => ['admin', 'user']
        ],

        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        [
            'name' => 'Usuarios',
            'route' => 'users.index',
            'icon' => 'group',
            'roles' => ['admin']
        ],

        [
            'name' => 'Nuevo Miembro',
            'route' => 'users.create',
            'icon' => 'person_add',
            'roles' => ['admin']
        ],

        [
            'name' => 'Membresías',
            'route' => 'memberships.index',
            'icon' => 'workspace_premium',
            'roles' => ['admin']
        ],

        [
            'name' => 'Reportes',
            'route' => 'reports.index',
            'icon' => 'analytics',
            'roles' => ['admin']
        ],

        /*
        |--------------------------------------------------------------------------
        | GYM DATA
        |--------------------------------------------------------------------------
        */

        [
            'name' => 'Músculos',
            'route' => 'muscles.index',
            'icon' => 'fitness_center',
            'roles' => ['admin']
        ],

        [
            'name' => 'Ejercicios',
            'route' => 'exercises.index',
            'icon' => 'exercise',
            'roles' => ['admin']
        ],

        [
            'name' => 'Máquinas',
            'route' => 'machines.index',
            'icon' => 'precision_manufacturing',
            'roles' => ['admin']
        ],

        /*
        |--------------------------------------------------------------------------
        | USER
        |--------------------------------------------------------------------------
        */

        [
            'name' => 'Biblioteca',
            'route' => 'exercises.library',
            'icon' => 'menu_book',
            'roles' => ['user']
        ],

        [
            'name' => 'Registrar Rutina',
            'route' => 'routines.create',
            'icon' => 'edit_note',
            'roles' => ['user']
        ],

        [
            'name' => 'Mis Rutinas',
            'route' => 'routines.index',
            'icon' => 'list_alt',
            'roles' => ['user']
        ],

    ];
@endphp

{{-- GOOGLE ICONS --}}
<link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
    rel="stylesheet"
/>

{{-- DESKTOP SIDEBAR --}}
<aside
    class="hidden md:flex flex-col fixed top-0 left-0 h-screen w-[290px]
    bg-[#1a1c1b]/95 backdrop-blur-2xl border-r border-white/5
    shadow-2xl z-50"
>

    {{-- LOGO --}}
    <div class="flex items-center gap-4 px-6 py-8 border-b border-white/5">

        <div
            class="w-14 h-14 rounded-2xl
            bg-[#aecdc5] text-[#183530]
            flex items-center justify-center
            font-bold text-2xl shadow-lg"
        >
            🏋️
        </div>

        <div>

            <h1 class="text-white font-bold text-xl tracking-tight">
                GymControl
            </h1>

            <p class="text-[#8b9290] text-xs uppercase tracking-[0.25em]">
                Pro
            </p>

        </div>

    </div>

    {{-- NAVIGATION --}}
    <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-2">

        @foreach($navigation as $item)

            @if($user && in_array($user->role ?? 'user', $item['roles']))

                <a
                    href="{{ route($item['route']) }}"
                    class="
                        group flex items-center gap-4
                        px-4 py-3 rounded-2xl
                        transition-all duration-200

                        {{ request()->routeIs($item['route'])
                            ? 'bg-[#3e503e]/40 text-[#d3e8d1] shadow-lg border border-[#aecdc5]/10'
                            : 'text-[#c1c8c5] hover:bg-white/5 hover:text-white'
                        }}
                    "
                >

                    <span class="material-symbols-outlined text-[22px]">
                        {{ $item['icon'] }}
                    </span>

                    <span class="font-medium tracking-wide">
                        {{ $item['name'] }}
                    </span>

                </a>

            @endif

        @endforeach

    </nav>

    {{-- USER PROFILE --}}
    <div class="mt-auto border-t border-white/5 p-5">

        <div class="flex items-center gap-3 mb-5">

            <div
                class="w-12 h-12 rounded-full
                bg-[#aecdc5] text-[#183530]
                flex items-center justify-center
                font-bold text-lg"
            >
                {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
            </div>

            <div class="min-w-0">

                <p class="font-semibold text-white truncate">
                    {{ $user->name ?? 'Usuario' }}
                </p>

                <p
                    class="text-[11px]
                    text-[#8b9290]
                    uppercase tracking-[0.18em]"
                >
                    {{ $isAdmin ? 'Administrador' : 'Miembro' }}
                </p>

            </div>

        </div>

        {{-- LOGOUT --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button
                type="submit"
                class="
                    w-full py-3 rounded-2xl
                    bg-red-500/90 hover:bg-red-500
                    text-white font-semibold
                    transition-all duration-200
                    shadow-lg hover:scale-[1.02]
                "
            >
                Cerrar sesión
            </button>

        </form>

    </div>

</aside>

{{-- MOBILE --}}
<div
    class="md:hidden"
    x-data="{ open:false }"
>

    {{-- OPEN BUTTON --}}
    <button
        @click="open = true"
        class="
            fixed top-4 left-4 z-50
            w-12 h-12 rounded-xl
            bg-[#1e201f]/95 text-white
            backdrop-blur-xl shadow-xl
            flex items-center justify-center
        "
    >
        <span class="material-symbols-outlined">
            menu
        </span>
    </button>

    {{-- OVERLAY --}}
    <div
        x-show="open"
        x-transition.opacity
        class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40"
        @click="open = false"
    ></div>

    {{-- MOBILE SIDEBAR --}}
    <aside
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="
            fixed top-0 left-0 z-50
            h-screen w-[290px]
            bg-[#1a1c1b]/95 backdrop-blur-2xl
            border-r border-white/5
            shadow-2xl flex flex-col
        "
    >

        {{-- HEADER --}}
        <div class="flex items-center justify-between px-6 py-8 border-b border-white/5">

            <div class="flex items-center gap-3">

                <div
                    class="w-12 h-12 rounded-2xl
                    bg-[#aecdc5] text-[#183530]
                    flex items-center justify-center
                    font-bold"
                >
                    🏋️
                </div>

                <div>

                    <h1 class="text-white font-bold text-lg">
                        GymControl
                    </h1>

                    <p class="text-[#8b9290] text-xs uppercase tracking-[0.2em]">
                        Pro
                    </p>

                </div>

            </div>

            <button
                @click="open = false"
                class="text-[#c1c8c5]"
            >
                <span class="material-symbols-outlined">
                    close
                </span>
            </button>

        </div>

        {{-- NAVIGATION --}}
        <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-2">

            @foreach($navigation as $item)

                @if($user && in_array($user->role ?? 'user', $item['roles']))

                    <a
                        href="{{ route($item['route']) }}"
                        @click="open = false"
                        class="
                            flex items-center gap-4
                            px-4 py-3 rounded-2xl
                            transition-all duration-200

                            {{ request()->routeIs($item['route'])
                                ? 'bg-[#3e503e]/40 text-[#d3e8d1]'
                                : 'text-[#c1c8c5] hover:bg-white/5 hover:text-white'
                            }}
                        "
                    >

                        <span class="material-symbols-outlined text-[22px]">
                            {{ $item['icon'] }}
                        </span>

                        <span class="font-medium tracking-wide">
                            {{ $item['name'] }}
                        </span>

                    </a>

                @endif

            @endforeach

        </nav>

        {{-- USER --}}
        <div class="border-t border-white/5 p-5">

            <div class="flex items-center gap-3 mb-5">

                <div
                    class="
                        w-12 h-12 rounded-full
                        bg-[#aecdc5]
                        text-[#183530]
                        flex items-center justify-center
                        font-bold
                    "
                >
                    {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                </div>

                <div>

                    <p class="font-semibold text-white">
                        {{ $user->name ?? 'Usuario' }}
                    </p>

                    <p class="text-[11px] text-[#8b9290] uppercase tracking-[0.2em]">
                        {{ $isAdmin ? 'Administrador' : 'Miembro' }}
                    </p>

                </div>

            </div>

            {{-- LOGOUT --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="
                        w-full py-3 rounded-2xl
                        bg-red-500/90 hover:bg-red-500
                        text-white font-semibold
                        transition-all duration-200
                    "
                >
                    Cerrar sesión
                </button>

            </form>

        </div>

    </aside>

</div>