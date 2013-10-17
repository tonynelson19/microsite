@extends('layouts.admin')

@section('content')

    <ol class="breadcrumb">
        <li><a href="{{ URL::route('admin.list-sections') }} ">Sections</a></li>
        <li class="active">{{ Util::clean($section->name) }}</li>
    </ol>

    <div class="container">
        <h1>{{ Util::clean($section->name) }}</h1>
        {{ View::make('admin.form-section', array('section' => $section, 'categories' => $categories)) }}
    </div>

@stop