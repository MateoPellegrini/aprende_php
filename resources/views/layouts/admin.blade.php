<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Admin')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-900">

    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-gray-800 text-white p-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">Admin - Aprende PHP</h1>
            <nav>
                <a href="{{ route('admin.temas.index') }}" class="mr-4">Temas</a>
                <a href="{{ route('admin.temas.create') }}">Nuevo Tema</a>
            </nav>
        </header>

        <!-- Contenido -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gray-200 text-center p-4">
            Aprende PHP © {{ date('Y') }}
        </footer>
    </div>

</body>
</html>
