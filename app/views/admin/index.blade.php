@extends('layouts.admin')

@section('content')

    <div class="container login col-lg-4 col-lg-offset-4">

        <h1>Login</h1>
        {{ Former::horizontal_open() }}
            {{ Former::text('username') }}
            {{ Former::password('password') }}
            {{ Former::actions()->primary_submit('Submit') }}
        {{ Former::close() }}

    </div>

@stop