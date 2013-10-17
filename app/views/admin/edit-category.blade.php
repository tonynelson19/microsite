@extends('layouts.admin')

@section('content')

    <ol class="breadcrumb">
        <li><a href="{{ URL::route('admin.list-sections') }} ">Sections</a></li>
        <li><a href="{{ URL::route('admin.edit-section', array('id' => $section->id)) }}">{{ Util::clean($section->name) }}</a></li>
        <li class="active">{{ Util::clean($category->name) }}</a></li>
    </ol>

    <div class="container">
        <h1>{{ Util::clean($category->name) }}</h1>
        {{ View::make('admin.form-category', array('category' => $category, 'products' => $products)) }}
        <a class="btn btn-danger" href="{{ URL::route('admin.delete-category', array('id' => $category->id)) }}" data-confirm="Are you sure you want to delete this category?">Delete</a>
    </div>

@stop