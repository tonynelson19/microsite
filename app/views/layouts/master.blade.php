<!DOCTYPE html>
<html>
    <head>
        <title>QA1 Products</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {{ HTML::style('css/bootstrap.min.css') }}
        {{ HTML::style('css/screen.css') }}
        {{ HTML::script('js/jquery-1.11.1.min.js') }}
        {{ HTML::script('js/bootstrap.min.js') }}
        {{ HTML::script('js/hammer.min.js') }}
        {{ HTML::script('js/main.js') }}
    </head>
    <body>
        <div class="wrapper">
            @yield('content')
        </div>
    </body>
</html>