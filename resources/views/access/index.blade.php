<!DOCTYPE html>
<html lang="es" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GymControl Pro</title>

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

    {{-- FONDO --}}
    <div class="fixed inset-0 bg-mesh"></div>

    {{-- LOGIN --}}
    <div class="relative z-10 w-full max-w-md px-4">

        <div class="glass rounded-[32px] shadow-2xl p-8 md:p-10">

            {{-- LOGO --}}
            <div class="text-center mb-8">

                <div class="w-20 h-20 mx-auto rounded-3xl
                            bg-emerald-500/10
                            border border-emerald-400/20
                            flex items-center justify-center
                            text-4xl mb-5">

                    🏋️

                </div>

                <h1 class="title-font text-4xl font-black tracking-tight text-white">
                    GymControl Pro
                </h1>

                <p class="text-gray-400 mt-2 text-sm">
                    Ingresa tu clave de acceso
                </p>

            </div>

            {{-- ERRORES --}}
            @if($errors->any())

                <div class="mb-6 rounded-2xl
                            border border-red-500/20
                            bg-red-500/10
                            p-4 text-sm text-red-300">

                    {{ $errors->first() }}

                </div>

            @endif

            {{-- FORM --}}
            <form action="{{ route('access.post') }}" method="POST" class="space-y-6">

                @csrf

                {{-- ACCESS KEY --}}
                <div>

                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Clave de acceso
                    </label>

                    <input
                        type="text"
                        name="access_key"
                        placeholder="Ej: GYM001"
                        autofocus

                        class="w-full rounded-2xl
                               border border-white/10
                               bg-black/30
                               px-4 py-4
                               text-center text-xl tracking-[0.3em]
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

                    Entrar

                </button>

            </form>

            {{-- REGISTER --}}
            <div class="mt-8 pt-6 border-t border-white/10 text-center">

                <p class="text-sm text-gray-500 mb-4">
                    ¿Eres nuevo en el gym?
                </p>

                <a href="{{ route('register') }}"
                   class="w-full inline-flex items-center justify-center
                          rounded-2xl
                          border border-white/10
                          bg-white/5
                          hover:bg-white/10
                          px-4 py-3
                          text-sm font-semibold text-white
                          transition">

                    Registrarse

                </a>

            </div>

        </div>

    </div>

</body>
</html>