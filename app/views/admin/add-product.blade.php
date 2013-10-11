@extends('layouts.admin')

@section('content')

    <ol class="breadcrumb">
        <li><a href="{{ URL::route('admin.list-sections') }} ">Sections</a></li>
        <li><a href="{{ URL::route('admin.edit-section', array('id' => $section->id)) }}">{{ $section->name }}</a></li>
        <li><a href="{{ URL::route('admin.edit-category', array('id' => $category->id)) }}">{{ $category->name }}</a></li>
        <li class="active">New Product</a></li>
    </ol>

    <div class="container">
        <h1>New Product</h1>
        {{ View::make('admin.form-product', array('product' => $product)) }}
    </div>

@stop