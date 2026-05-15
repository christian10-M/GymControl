<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Admin — GymControl Pro</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 min-h-screen flex items-center justify-center">

    <div class="bg-gray-800 rounded-2xl shadow-xl p-10 w-full max-w-sm text-center">

        <h1 class="text-2xl font-bold text-white mb-1">Acceso Administrador</h1>
        <p class="text-gray-400 mb-8 text-sm">Ingresa tu contraseña</p>

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-900 text-red-200 rounded text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('access.admin.post') }}" method="POST">
            @csrf
            <input
                type="password"
                name="password"
                placeholder="Contraseña"
                autofocus
                class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg
                       px-4 py-3 mb-4 focus:outline-none focus:border-blue-500"
            >
            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold
                           py-3 rounded-lg transition">
                Ingresar
            </button>
        </form>

        <a href="{{ route('access') }}" class="text-gray-500 text-sm mt-4 inline-block hover:text-gray-300">
            ← Volver
        </a>
    </div>

</body>
</html>