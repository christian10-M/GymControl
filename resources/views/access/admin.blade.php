<!DOCTYPE html>
<html lang="es" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Acceso Admin — GymControl Pro</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .title-font {
            font-family: 'Montserrat', sans-serif;
        }

        .bg-mesh {
            background:
                radial-gradient(circle at top left, rgba(16, 185, 129, 0.12), transparent 30%),
                radial-gradient(circle at bottom right, rgba(59, 130, 246, 0.10), transparent 30%);
        }

        .glass {
            background: rgba(255,255,255,0.04);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.08);
        }
    </style>

</head>

<body class="bg-[#0a0a0a] min-h-screen flex items-center justify-center overflow-hidden text-white">

    {{-- BACKGROUND --}}
    <div class="fixed inset-0 bg-mesh"></div>

    {{-- CARD --}}
    <div class="relative z-10 w-full max-w-md px-4">

        <div class="glass rounded-[32px] shadow-2xl p-8 md:p-10">

            {{-- HEADER --}}
            <div class="text-center mb-8">

                <h1 class="title-font text-4xl font-black tracking-tight text-white">
                    Acceso Admin
                </h1>

                <p class="text-gray-400 mt-2 text-sm">
                    Verificación segura de administrador
                </p>

            </div>

            {{-- ERRORS --}}
            @if($errors->any())

                <div class="mb-6 rounded-2xl
                            border border-red-500/20
                            bg-red-500/10
                            p-4 text-sm text-red-300">

                    {{ $errors->first() }}

                </div>

            @endif

            {{-- FORM --}}
            <form action="{{ route('access.admin.post') }}" method="POST" class="space-y-6">

                @csrf

                {{-- PASSWORD --}}
                <div>

                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Contraseña
                    </label>

                    <input
                        type="password"
                        name="password"
                        placeholder="••••••••"
                        autofocus

                        class="w-full rounded-2xl
                               border border-white/10
                               bg-black/30
                               px-4 py-4
                               text-white
                               placeholder-gray-500
                               focus:border-emerald-400
                               focus:ring focus:ring-emerald-400/20
                               focus:outline-none transition">

                </div>

                {{-- BUTTON --}}
                <button
                    type="submit"

                    class="w-full rounded-2xl
                           bg-emerald-500
                           hover:bg-emerald-400
                           py-4
                           font-bold
                           text-black
                           transition
                           hover:scale-[1.01]
                           active:scale-[0.99]">

                    Ingresar al Panel

                </button>

            </form>

            {{-- BACK --}}
            <div class="mt-8 pt-6 border-t border-white/10 text-center">

                <a href="{{ route('login') }}"
                   class="inline-flex items-center gap-2
                          text-sm text-gray-400
                          hover:text-white transition">

                    <span>←</span>
                    <span>Volver al acceso principal</span>

                </a>

            </div>

        </div>

    </div>

</body>
</html>