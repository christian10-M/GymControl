<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymControl Pro</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 min-h-screen flex items-center justify-center">

    <div class="bg-gray-800 rounded-2xl shadow-xl p-10 w-full max-w-sm text-center">

        <h1 class="text-3xl font-bold text-white mb-1">GymControl Pro</h1>
        <p class="text-gray-400 mb-8 text-sm">Ingresa tu clave de acceso</p>

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-900 text-red-200 rounded text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('access.post') }}" method="POST">
            @csrf
            <input
                type="text"
                name="access_key"
                placeholder="Ej: GYM001"
                autofocus
                class="w-full bg-gray-700 text-white text-center text-xl tracking-widest
                       border border-gray-600 rounded-lg px-4 py-3 mb-4
                       focus:outline-none focus:border-blue-500"
            >
            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold
                           py-3 rounded-lg transition mb-4">
                Entrar
            </button>
        </form>

        <div class="border-t border-gray-700 pt-4">
            <p class="text-gray-500 text-sm mb-3">¿Eres nuevo en el gym?</p>
            <a href="{{ route('register') }}"
               class="w-full inline-block bg-gray-700 hover:bg-gray-600 text-white
                      font-semibold py-3 rounded-lg transition text-sm">
                Registrarse
            </a>
        </div>

    </div>

</body>
</html>