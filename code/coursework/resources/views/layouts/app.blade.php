<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <style> body{font-family: Helvetica, sans-serif;} </style>
</head>
<section>
    <header>
        
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