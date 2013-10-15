@extends('layouts.admin')

@section('content')

    <ol class="breadcrumb">
        <li><a href="{{ URL::route('admin.list-sections') }} ">Sections</a></li>
        <li><a href="{{ URL::route('admin.edit-section', array('id' => $section->id)) }}">{{ Util::clean($section->name) }}</a></li>
        <li class="active">New Category</a></li>
    </ol>

    <div class="container">
        <h1>New Category</h1>
        {{ View::make('admin.form-category', array('category' => $category)) }}
    </div>

@stop