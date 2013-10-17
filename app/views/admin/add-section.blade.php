@extends('layouts.admin')

@section('content')

    <ol class="breadcrumb">
        <li><a href="{{ URL::route('admin.list-sections') }} ">Sections</a></li>
        <li class="active">New Section</li>
    </ol>

    <div class="container">
        <h1>New Section</h1>
        {{ View::make('admin.form-section', array('section' => $section, 'categories' => $categories)) }}
    </div>

@stop