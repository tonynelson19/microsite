@extends('layouts.admin')

@section('content')

    <ol class="breadcrumb">
        <li><a href="{{ URL::route('admin.list-sections') }} ">Sections</a></li>
        <li class="active">{{ Util::clean($section->name) }}</li>
    </ol>

    <div class="container">
        <h1>{{ Util::clean($section->name) }}</h1>
        {{ View::make('admin.form-section', array('section' => $section, 'categories' => $categories)) }}
        <a class="btn btn-danger" href="{{ URL::route('admin.delete-section', array('id' => $section->id)) }}" data-confirm="Are you sure you want to delete this section?">Delete</a>
    </div>

@stop