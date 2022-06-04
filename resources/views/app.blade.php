<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    @routes
    <script src="{{ mix('js/app.js') }}" defer></script>
    @inertiaHead
</head>

<body id="themeDiv" class="font-sans antialiased">
    @inertia

    @env ('local')
    <!--
    <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>
    -->
    @endenv
    <button onclick="topFunction()" id="backToTop" title="Go to top" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-indigo-400 rounded-lg hover:bg-indigo-600 focus:ring-4 focus:outline-none focus:ring-indigo-300">
        Top
    </button>
</body>
<script defer>
    if (localStorage.getItem("darkMode") == "true") {
        document.getElementById("themeDiv").classList.add("dark");
    }
    window.onscroll = function() {
        scrollFunction()
    };
    const topFunction = () => {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    };
    const mybutton = document.getElementById("backToTop");
    const scrollFunction = () => {
        if (
            document.body.scrollTop > 20 ||
            document.documentElement.scrollTop > 20
        ) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    };
</script>

</html>