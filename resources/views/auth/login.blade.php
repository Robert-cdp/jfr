<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colegio José Francisco Rivas</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            200: '#c7d2fe',
                            300: '#a5b4fc',
                            400: '#818cf8',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#312e81',
                            950: '#1e1b4b',
                        },
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f8fafc 0%, #eef2ff 100%);
        }
    </style>
</head>
<body class="font-sans antialiased h-screen flex items-center justify-center p-4">

    <div class="max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden grid grid-cols-1 lg:grid-cols-2">

        <div class="p-8 lg:p-12 flex flex-col justify-center order-2 lg:order-1">

            <h2 class="text-2xl font-bold text-slate-800 mb-1">¡Bienvenido de nuevo!</h2>
            <p class="text-slate-500 mb-8">Ingresa tus credenciales para acceder al sistema.</p>

            <form class="space-y-5" action="{{ route('login') }}" method="POST">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Correo electrónico</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <input
                            type="email"
                            id="email"
                            placeholder="admin@jfr.edu.gt"
                            class="w-full pl-10 pr-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-brand-300 focus:border-brand-400 outline-none transition-all"
                        >
                    </div>
                </div>

                <!-- Contraseña -->
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Contraseña</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input
                            type="password"
                            id="password"
                            placeholder="••••••••"
                            class="w-full pl-10 pr-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-brand-300 focus:border-brand-400 outline-none transition-all"
                        >
                    </div>
                </div>

                <button
                    type="submit"
                    class="w-full py-3 px-4 bg-brand-600 hover:bg-brand-700 text-white font-semibold rounded-xl shadow-lg shadow-brand-200/50 transition-all hover:shadow-brand-300/50 focus:outline-none focus:ring-2 focus:ring-brand-400 focus:ring-offset-2"
                >
                    Iniciar Sesión
                </button>
            </form>

        </div>

        <div class="relative overflow-hidden bg-gradient-to-br from-brand-700 to-brand-950 p-8 lg:p-12 flex items-center justify-center order-1 lg:order-2 min-h-[250px] lg:min-h-0">

            <div class="absolute inset-0 opacity-10">
                <div class="absolute -top-24 -right-24 w-96 h-96 bg-brand-400 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-brand-600 rounded-full blur-3xl"></div>
            </div>

            <div class="relative z-10 text-center">
                <div class="w-40 h-40 lg:w-56 lg:h-56 mx-auto mb-6 rounded-full bg-white/10 backdrop-blur-sm p-4 shadow-2xl">
                    <img
                        src="{{ asset('img/colegio.jpeg') }}"
                        alt="Logo del Colegio"
                        class="w-full h-full object-contain rounded-full"
                        onerror="this.onerror=null; this.parentNode.innerHTML='<div class=\'w-full h-full flex items-center justify-center text-6xl\'>🏫</div>';"
                    >
                </div>

                <h2 class="text-2xl lg:text-3xl font-bold text-white mb-2">Colegio José Francisco Rivas</h2>
                <p class="text-brand-200 text-sm lg:text-base">Formando líderes del mañana</p>

                <div class="mt-6 flex justify-center">
                    <div class="w-16 h-1 bg-brand-400 rounded-full"></div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>