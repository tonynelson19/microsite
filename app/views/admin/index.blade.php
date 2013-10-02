@extends('layouts.admin')

@section('content')

    {{ Former::horizontal_open() }}

        {{ Former::text('username') }}

        {{ Former::password('password') }}

        {{ Former::actions()->large_primary_submit('Submit') }}

    {{ Former::close() }}

@stop