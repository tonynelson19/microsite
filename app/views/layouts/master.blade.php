<!DOCTYPE html>
<html>
    <head>
        <title>Microsite</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {{ HTML::style('css/bootstrap.min.css') }}
        {{ HTML::style('css/screen.css') }}
        {{ HTML::script('js/jquery-1.10.2.min.js') }}
        {{ HTML::script('js/jquery.pjax.js') }}
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