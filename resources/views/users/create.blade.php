<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col gap-2">

            <h1 class="text-3xl md:text-4xl font-black tracking-tight text-white">
                Nuevo Miembro
            </h1>

            <p class="text-gray-400">
                Registrar un nuevo usuario dentro del sistema GymControl Pro
            </p>

        </div>

    </x-slot>

    <div class="p-4 md:p-8">

        <div class="max-w-5xl mx-auto">

            {{-- CARD --}}
            <div
                class="rounded-[32px]
                       border border-white/10
                       bg-white/5 backdrop-blur-2xl
                       overflow-hidden shadow-2xl"
            >

                {{-- TOP --}}
                <div
                    class="relative overflow-hidden
                           border-b border-white/10
                           px-6 md:px-10 py-8"
                >

                    <div class="absolute inset-0
                                bg-gradient-to-r
                                from-emerald-500/10
                                via-cyan-500/5
                                to-transparent">
                    </div>

                    <div class="relative z-10 flex items-center gap-5">

                        <div
                            class="w-20 h-20 rounded-3xl
                                   bg-emerald-500/15
                                   border border-emerald-400/20
                                   flex items-center justify-center"
                        >

                            <span class="material-symbols-outlined text-5xl text-emerald-300">
                                person_add
                            </span>

                        </div>

                        <div>

                            <h2 class="text-2xl md:text-3xl font-black text-white">
                                Registro de miembro
                            </h2>

                            <p class="text-gray-400 mt-2">
                                Completa la información del nuevo socio del gimnasio
                            </p>

                        </div>

                    </div>

                </div>

                {{-- FORM --}}
                <form
                    method="POST"
                    action="{{ route('users.store') }}"
                    class="p-6 md:p-10"
                >

                    @csrf

                    {{-- ERRORS --}}
                    @if($errors->any())

                        <div
                            class="mb-8 rounded-3xl
                                   border border-red-500/20
                                   bg-red-500/10
                                   p-5"
                        >

                            <div class="flex items-center gap-3 mb-4">

                                <span class="material-symbols-outlined text-red-300">
                                    error
                                </span>

                                <h3 class="font-bold text-red-200">
                                    Corrige los siguientes errores
                                </h3>

                            </div>

                            <ul class="space-y-2 text-sm text-red-200">

                                @foreach($errors->all() as $error)

                                    <li>
                                        • {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    @endif

                    {{-- GRID --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- NAME --}}
                        <div class="md:col-span-2">

                            <label class="block text-sm font-medium text-gray-300 mb-3">
                                Nombre completo
                            </label>

                            <div class="relative">

                                <span
                                    class="material-symbols-outlined
                                           absolute left-4 top-1/2 -translate-y-1/2
                                           text-gray-500"
                                >
                                    badge
                                </span>

                                <input
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    required
                                    autofocus
                                    placeholder="Ej: Juan Pérez"
                                    class="w-full rounded-2xl
                                           border border-white/10
                                           bg-black/20
                                           pl-14 pr-4 py-4
                                           text-white
                                           placeholder-gray-500
                                           focus:border-emerald-400
                                           focus:ring focus:ring-emerald-400/20
                                           outline-none transition"
                                >

                            </div>

                        </div>

                        {{-- EMAIL --}}
                        <div>

                            <label class="block text-sm font-medium text-gray-300 mb-3">
                                Correo electrónico
                            </label>

                            <div class="relative">

                                <span
                                    class="material-symbols-outlined
                                           absolute left-4 top-1/2 -translate-y-1/2
                                           text-gray-500"
                                >
                                    mail
                                </span>

                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    placeholder="usuario@gym.com"
                                    class="w-full rounded-2xl
                                           border border-white/10
                                           bg-black/20
                                           pl-14 pr-4 py-4
                                           text-white
                                           placeholder-gray-500
                                           focus:border-emerald-400
                                           focus:ring focus:ring-emerald-400/20
                                           outline-none transition"
                                >

                            </div>

                        </div>

                        {{-- ACCESS KEY --}}
                        <div>

                            <label class="block text-sm font-medium text-gray-300 mb-3">
                                Clave de acceso
                            </label>

                            <div class="relative">

                                <span
                                    class="material-symbols-outlined
                                           absolute left-4 top-1/2 -translate-y-1/2
                                           text-gray-500"
                                >
                                    vpn_key
                                </span>

                                <input
                                    type="text"
                                    name="access_key"
                                    value="{{ old('access_key') }}"
                                    required
                                    placeholder="GYM001"
                                    class="w-full rounded-2xl
                                           border border-white/10
                                           bg-black/20
                                           pl-14 pr-4 py-4
                                           uppercase tracking-[0.25em]
                                           text-white
                                           placeholder-gray-500
                                           focus:border-emerald-400
                                           focus:ring focus:ring-emerald-400/20
                                           outline-none transition"
                                >

                            </div>

                        </div>

                        {{-- CURP --}}
                        <div>

                            <label class="block text-sm font-medium text-gray-300 mb-3">
                                CURP
                            </label>

                            <div class="relative">

                                <span
                                    class="material-symbols-outlined
                                           absolute left-4 top-1/2 -translate-y-1/2
                                           text-gray-500"
                                >
                                    fingerprint
                                </span>

                                <input
                                    type="text"
                                    name="curp"
                                    maxlength="18"
                                    value="{{ old('curp') }}"
                                    required
                                    placeholder="CURP"
                                    class="w-full rounded-2xl
                                           border border-white/10
                                           bg-black/20
                                           pl-14 pr-4 py-4
                                           uppercase
                                           text-white
                                           placeholder-gray-500
                                           focus:border-emerald-400
                                           focus:ring focus:ring-emerald-400/20
                                           outline-none transition"
                                >

                            </div>

                        </div>

                        {{-- AGE --}}
                        <div>

                            <label class="block text-sm font-medium text-gray-300 mb-3">
                                Edad
                            </label>

                            <div class="relative">

                                <span
                                    class="material-symbols-outlined
                                           absolute left-4 top-1/2 -translate-y-1/2
                                           text-gray-500"
                                >
                                    cake
                                </span>

                                <input
                                    type="number"
                                    name="age"
                                    min="14"
                                    max="99"
                                    value="{{ old('age') }}"
                                    required
                                    placeholder="18"
                                    class="w-full rounded-2xl
                                           border border-white/10
                                           bg-black/20
                                           pl-14 pr-4 py-4
                                           text-white
                                           placeholder-gray-500
                                           focus:border-emerald-400
                                           focus:ring focus:ring-emerald-400/20
                                           outline-none transition"
                                >

                            </div>

                        </div>

                        {{-- GENDER --}}
                        <div>

                            <label class="block text-sm font-medium text-gray-300 mb-3">
                                Género
                            </label>

                            <select
                                name="gender"
                                required
                                class="w-full rounded-2xl
                                       border border-white/10
                                       bg-black/20
                                       px-4 py-4
                                       text-white
                                       focus:border-emerald-400
                                       focus:ring focus:ring-emerald-400/20
                                       outline-none transition"
                            >

                                <option value="" class="bg-[#111]">
                                    Selecciona
                                </option>

                                <option
                                    value="male"
                                    class="bg-[#111]"
                                >
                                    Masculino
                                </option>

                                <option
                                    value="female"
                                    class="bg-[#111]"
                                >
                                    Femenino
                                </option>

                                <option
                                    value="other"
                                    class="bg-[#111]"
                                >
                                    Otro
                                </option>

                            </select>

                        </div>
                        {{-- ROLE --}}
<div class="md:col-span-2">

    <label class="block text-sm font-medium text-gray-300 mb-3">
        Tipo de usuario
    </label>

    <select
        id="role"
        name="role"
        required
        onchange="togglePasswordFields()"
        class="w-full rounded-2xl
               border border-white/10
               bg-black/20
               px-4 py-4
               text-white
               focus:border-emerald-400
               focus:ring focus:ring-emerald-400/20
               outline-none transition"
    >

        <option value="user" class="bg-[#111]">
            Miembro
        </option>

        <option value="admin" class="bg-[#111]">
            Administrador
        </option>

    </select>

</div>
{{-- PASSWORD SECTION --}}
<div
    id="password-section"
    class="md:col-span-2 hidden"
>

    <div class="grid md:grid-cols-2 gap-6">

        {{-- PASSWORD --}}
        <div>

            <label class="block text-sm font-medium text-gray-300 mb-3">
                Contraseña
            </label>

            <div class="relative">

                <span
                    class="material-symbols-outlined
                           absolute left-4 top-1/2 -translate-y-1/2
                           text-gray-500"
                >
                    lock
                </span>

                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="••••••••"
                    class="w-full rounded-2xl
                           border border-white/10
                           bg-black/20
                           pl-14 pr-4 py-4
                           text-white
                           placeholder-gray-500
                           focus:border-emerald-400
                           focus:ring focus:ring-emerald-400/20
                           outline-none transition"
                >

            </div>

        </div>

        {{-- CONFIRM --}}
        <div>

            <label class="block text-sm font-medium text-gray-300 mb-3">
                Confirmar contraseña
            </label>

            <div class="relative">

                <span
                    class="material-symbols-outlined
                           absolute left-4 top-1/2 -translate-y-1/2
                           text-gray-500"
                >
                    shield_lock
                </span>

                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    placeholder="••••••••"
                    class="w-full rounded-2xl
                           border border-white/10
                           bg-black/20
                           pl-14 pr-4 py-4
                           text-white
                           placeholder-gray-500
                           focus:border-emerald-400
                           focus:ring focus:ring-emerald-400/20
                           outline-none transition"
                >

            </div>

        </div>

    </div>

</div>
                    </div>
                    {{-- MEMBERSHIP --}}
<div class="md:col-span-2">

    <div class="flex items-center gap-3 mb-4">

        <div class="w-10 h-10 rounded-xl bg-cyan-500/15 flex items-center justify-center">
            <span class="material-symbols-outlined text-cyan-300">
                workspace_premium
            </span>
        </div>

        <div>
            <h3 class="text-lg font-bold text-white">
                Membresía
            </h3>

            <p class="text-sm text-gray-400">
                Configuración del plan del miembro
            </p>
        </div>

    </div>

</div>

{{-- TYPE --}}
<div>

    <label class="block text-sm font-medium text-gray-300 mb-3">
        Tipo de membresía
    </label>

    <select
        name="membership_type"
        class="w-full rounded-2xl
               border border-white/10
               bg-black/20
               px-4 py-4
               text-white
               focus:border-cyan-400
               focus:ring focus:ring-cyan-400/20
               outline-none transition"
    >

        <option value="mensual" class="bg-[#111]">
            Mensual
        </option>

        <option value="trimestral" class="bg-[#111]">
            Trimestral
        </option>

        <option value="anual" class="bg-[#111]">
            Anual
        </option>

    </select>

</div>

{{-- START DATE --}}
<div>

    <label class="block text-sm font-medium text-gray-300 mb-3">
        Inicio de membresía
    </label>

    <input
        type="date"
        name="membership_start"
        value="{{ now()->format('Y-m-d') }}"
        class="w-full rounded-2xl
               border border-white/10
               bg-black/20
               px-4 py-4
               text-white
               focus:border-cyan-400
               focus:ring focus:ring-cyan-400/20
               outline-none transition"
    >

</div>

                    {{-- ACTIONS --}}
                    <div
                        class="mt-10 pt-8 border-t border-white/10
                               flex flex-col sm:flex-row gap-4 justify-end"
                    >

                        <a
                            href="{{ route('users.index') }}"
                            class="px-6 py-4 rounded-2xl
                                   border border-white/10
                                   text-gray-300 hover:bg-white/5
                                   transition text-center"
                        >

                            Cancelar

                        </a>

                        <button
                            type="submit"
                            class="px-8 py-4 rounded-2xl
                                   bg-emerald-400 hover:bg-emerald-300
                                   text-black font-bold
                                   transition-all duration-200
                                   hover:scale-[1.02]
                                   active:scale-[0.98]
                                   shadow-xl shadow-emerald-500/20"
                        >

                            Registrar miembro

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>
<script>
    function togglePasswordFields() {

        const role = document.getElementById('role').value;

        const section = document.getElementById('password-section');

        const password = document.getElementById('password');

        const confirmation = document.getElementById('password_confirmation');

        if (role === 'admin') {

            section.classList.remove('hidden');

            password.setAttribute('required', true);

            confirmation.setAttribute('required', true);

        } else {

            section.classList.add('hidden');

            password.removeAttribute('required');

            confirmation.removeAttribute('required');

        }
    }

    togglePasswordFields();
</script>