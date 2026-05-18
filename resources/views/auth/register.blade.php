<!DOCTYPE html>
<html lang="es" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registro | GymControl Pro</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&family=Inter:wght@400;500;600&family=Material+Symbols+Outlined"
        rel="stylesheet"
    >

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .title-font {
            font-family: 'Montserrat', sans-serif;
        }

        .bg-mesh {
            background:
                radial-gradient(circle at top left, rgba(16,185,129,.12), transparent 30%),
                radial-gradient(circle at bottom right, rgba(59,130,246,.10), transparent 30%);
        }

        .glass {
            background: rgba(255,255,255,0.04);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.08);
        }

        /* SCROLL BONITO EN MOBILE */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,.08);
            border-radius: 999px;
        }
    </style>

</head>

<body class="bg-[#0a0a0a] min-h-screen text-white overflow-x-hidden">

    {{-- BACKGROUND --}}
    <div class="fixed inset-0 bg-mesh"></div>

    <main class="relative z-10 min-h-screen flex items-center justify-center px-4 py-6 sm:px-6 sm:py-10">

        <div class="w-full max-w-2xl">

            {{-- HEADER --}}
            <div class="text-center mb-6 sm:mb-8">

                <div class="mb-5 flex justify-center">

                    <div
                        class="w-16 h-16 sm:w-20 sm:h-20 rounded-3xl
                               bg-emerald-400/20 border border-emerald-400/20
                               flex items-center justify-center
                               shadow-2xl shadow-emerald-500/10"
                    >

                        <span class="material-symbols-outlined text-4xl sm:text-5xl text-emerald-300">
                            fitness_center
                        </span>

                    </div>

                </div>

                <h1 class="title-font text-3xl sm:text-5xl font-black tracking-tight">
                    GymControl Pro
                </h1>

                <p class="text-gray-400 mt-3 text-sm sm:text-base px-2">
                    Registro de nuevo miembro
                </p>

            </div>

            {{-- CARD --}}
            <div
                class="glass rounded-[28px] sm:rounded-[32px]
                       p-5 sm:p-8 md:p-10 shadow-2xl"
            >

                {{-- ERRORS --}}
                @if($errors->any())

                    <div
                        class="mb-6 rounded-2xl border border-red-500/20
                               bg-red-500/10 p-4 text-sm text-red-300"
                    >

                        <ul class="space-y-1">
                            @foreach($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>

                @endif

                <form method="POST" action="{{ route('register') }}">

                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5">

                        {{-- NOMBRE --}}
                        <div class="md:col-span-2">

                            <label class="block text-sm text-gray-300 mb-2">
                                Nombre completo
                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                placeholder="Ej: Juan Pérez"
                                class="w-full rounded-2xl border border-white/10
                                       bg-black/30 px-4 py-3 sm:py-4
                                       text-sm sm:text-base
                                       text-white placeholder-gray-500
                                       focus:border-emerald-400
                                       focus:ring focus:ring-emerald-400/20
                                       focus:outline-none transition"
                            >

                        </div>

                        {{-- EMAIL --}}
                        <div>

                            <label class="block text-sm text-gray-300 mb-2">
                                Correo electrónico
                            </label>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                placeholder="usuario@gym.com"
                                class="w-full rounded-2xl border border-white/10
                                       bg-black/30 px-4 py-3 sm:py-4
                                       text-sm sm:text-base
                                       text-white placeholder-gray-500
                                       focus:border-emerald-400
                                       focus:ring focus:ring-emerald-400/20
                                       focus:outline-none transition"
                            >

                        </div>

                        {{-- CURP --}}
                        <div>

                            <label class="block text-sm text-gray-300 mb-2">
                                CURP
                            </label>

                            <input
                                type="text"
                                name="curp"
                                maxlength="18"
                                value="{{ old('curp') }}"
                                required
                                placeholder="CURP"
                                class="w-full uppercase rounded-2xl border border-white/10
                                       bg-black/30 px-4 py-3 sm:py-4
                                       text-sm sm:text-base
                                       text-white placeholder-gray-500
                                       focus:border-emerald-400
                                       focus:ring focus:ring-emerald-400/20
                                       focus:outline-none transition"
                            >

                        </div>

                        {{-- ACCESS KEY --}}
                        <div>

                            <label class="block text-sm text-gray-300 mb-2">
                                Clave de acceso
                            </label>

                            <input
                                type="text"
                                name="access_key"
                                value="{{ old('access_key') }}"
                                required
                                placeholder="Ej: GYM001"
                                class="w-full uppercase rounded-2xl border border-white/10
                                       bg-black/30 px-4 py-3 sm:py-4
                                       text-sm sm:text-base
                                       tracking-[0.15em] sm:tracking-[0.2em]
                                       text-white placeholder-gray-500
                                       focus:border-emerald-400
                                       focus:ring focus:ring-emerald-400/20
                                       focus:outline-none transition"
                            >

                        </div>

                        {{-- EDAD --}}
                        <div>

                            <label class="block text-sm text-gray-300 mb-2">
                                Edad
                            </label>

                            <input
                                type="number"
                                name="age"
                                min="14"
                                max="99"
                                value="{{ old('age') }}"
                                required
                                placeholder="18"
                                class="w-full rounded-2xl border border-white/10
                                       bg-black/30 px-4 py-3 sm:py-4
                                       text-sm sm:text-base
                                       text-white placeholder-gray-500
                                       focus:border-emerald-400
                                       focus:ring focus:ring-emerald-400/20
                                       focus:outline-none transition"
                            >

                        </div>

                        {{-- GENERO --}}
                        <div>

                            <label class="block text-sm text-gray-300 mb-2">
                                Género
                            </label>

                            <select
                                name="gender"
                                required
                                class="w-full rounded-2xl border border-white/10
                                       bg-black/30 px-4 py-3 sm:py-4
                                       text-sm sm:text-base
                                       text-white
                                       focus:border-emerald-400
                                       focus:ring focus:ring-emerald-400/20
                                       focus:outline-none transition"
                            >

                                <option value="">Selecciona</option>

                                <option value="male">
                                    Masculino
                                </option>

                                <option value="female">
                                    Femenino
                                </option>

                                <option value="other">
                                    Otro
                                </option>

                            </select>

                        </div>

                        {{-- PASSWORD --}}
                        <div>

                            <label class="block text-sm text-gray-300 mb-2">
                                Contraseña
                            </label>

                            <input
                                type="password"
                                name="password"
                                required
                                placeholder="••••••••"
                                class="w-full rounded-2xl border border-white/10
                                       bg-black/30 px-4 py-3 sm:py-4
                                       text-sm sm:text-base
                                       text-white placeholder-gray-500
                                       focus:border-emerald-400
                                       focus:ring focus:ring-emerald-400/20
                                       focus:outline-none transition"
                            >

                        </div>

                        {{-- CONFIRM --}}
                        <div>

                            <label class="block text-sm text-gray-300 mb-2">
                                Confirmar contraseña
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                required
                                placeholder="••••••••"
                                class="w-full rounded-2xl border border-white/10
                                       bg-black/30 px-4 py-3 sm:py-4
                                       text-sm sm:text-base
                                       text-white placeholder-gray-500
                                       focus:border-emerald-400
                                       focus:ring focus:ring-emerald-400/20
                                       focus:outline-none transition"
                            >

                        </div>

                    </div>

                    {{-- BUTTON --}}
                    <button
                        type="submit"
                        class="mt-6 sm:mt-8 w-full rounded-2xl
                               bg-emerald-400 hover:bg-emerald-300
                               py-3 sm:py-4
                               text-sm sm:text-base
                               font-bold text-black
                               transition hover:scale-[1.01]
                               active:scale-[0.99]"
                    >

                        Registrar miembro

                    </button>

                </form>

                {{-- LOGIN --}}
                <div class="mt-6 sm:mt-8 border-t border-white/10 pt-5 sm:pt-6 text-center">

                    <a
                        href="{{ route('login') }}"
                        class="text-sm text-gray-400 hover:text-white transition"
                    >

                        ← Volver al acceso

                    </a>

                </div>

            </div>

        </div>

    </main>

</body>
</html>