<html lang="en">
<head>
    <title>
        {{ $title }}
    </title>
</head>
<body>

    <div class="menu">
        @include('menu.menu')
    </div>

    <div class="container">
        @yield('content')
    </div>

</body>
</html>
