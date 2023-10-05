<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bienvenida al Colegio XYZ</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f0f4f7;
        }

        .header {
            background-color: #003366;
            color: #ffffff;
            padding: 2rem;
            text-align: center;
        }

        .logo {
            width: 100px;
            height: auto;
        }

        .main-content {
            text-align: center;
            padding: 2rem;
        }

        .welcome-text {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .cta-button {
            display: inline-block;
            background-color: #ff6600;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            margin-right: 10px;
        }

        .cta-button:hover {
            background-color: #ff5500;
        }
    </style>
</head>
<body class="antialiased">
    <div class="header">
        <img src="https://claretiano.edu.co/wp-content/uploads/2021/09/colegioclaretiano-180x82.png" alt="img" class="logo">
        <h1>Bienvenidos al Colegio Claretiano</h1>
    </div>

    <div class="main-content">
        @auth
        <div class="welcome-text">
            ¡Bienvenido(a), {{ Auth::user()->name }}!
        </div>
        @else
        <div class="welcome-text">
            ¡Bienvenidos a nuestra comunidad educativa!
        </div>
        <p>Somos un colegio comprometido con la excelencia académica y el desarrollo integral de nuestros estudiantes.</p>
        <p>Explora nuestras instalaciones y programas educativos.</p>
        @endauth

        <!-- Botones de Login, Registro e Inicio -->
        <div>
            @guest
            <a href="{{ route('login') }}" class="cta-button">Login</a>
            @else
            <a href="{{ route('home') }}" class="cta-button">Inicio</a>
            @endguest
        </div>
    </div>

    <!-- Resto del contenido se mantiene igual -->
    <!-- ... -->

</body>
</html>
