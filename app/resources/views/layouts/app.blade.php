<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App - Cadastro</title>
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- FAVICON --}}
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ env('APP_URL_PUBLIC') }}/apple-touch-icon.png?v={{ env('VERSION') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ env('APP_URL_PUBLIC') }}/favicon-32x32.png?v={{ env('VERSION') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ env('APP_URL_PUBLIC') }}/favicon-16x16.png?v={{ env('VERSION') }}">
    <link rel="manifest" href="{{ env('APP_URL_PUBLIC') }}/site.webmanifest?v={{ env('VERSION') }}">
</head>

<body>
    <nav class="relative px-4 py-2 flex justify-between items-center bg-gray-800 border-b-2 border-gray-600">
        <a class="text-2xl font-bold text-white" href="#">
            App - Cadastro
        </a>
        <div>
            <a class=" py-1.5 px-3 m-1 text-center border border-gray-300 rounded-md text-black hover:text-black hover:bg-gray-100 text-white text-gray-300 bg-gray-700 inline-block w-[10vw]"
                href="{{ url('/logout') }}">
                Sair
            </a>
        </div>

    </nav>
    <div class="@yield('style', 'shadow-md bg-white border rounded-lg px-8 py-6 mx-auto my-8 max-w-2xl')">
        <h2 class="text-2xl font-medium mb-4">@yield('title')</h2>
        @yield('content')
    </div>
</body>

</html>
