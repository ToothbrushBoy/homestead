<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <style> body{font-family: Helvetica, sans-serif;} </style>
</head>
<section>
    <header>
        top bar
    </header>
</section>
<body>
    <header>
        @yield('header')
    </header>

    <div>
        @yield('content')
    </div>

</body>
    
@yield('script')

</html>