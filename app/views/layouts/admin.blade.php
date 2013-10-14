<!DOCTYPE html>
<html>
    <head>
        <title>QA1 Product Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {{ HTML::style('css/bootstrap.min.css') }}
        {{ HTML::style('css/screen.css') }}
        {{ HTML::script('js/jquery-1.10.2.min.js') }}
        {{ HTML::script('js/bootstrap.min.js') }}
        {{ HTML::script('plugins/ckeditor/ckeditor.js') }}
        {{ HTML::script('plugins/ckeditor/adapters/jquery.js') }}
        {{ HTML::script('js/admin.js') }}
    </head>
    <body>
        @yield('content')
    </body>
</html>