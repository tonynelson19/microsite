@extends('layouts.admin')

@section('content')

    <ol class="breadcrumb">
        <li><a href="{{ URL::route('admin.list-sections') }} ">Sections</a></li>
        <li><a href="{{ URL::route('admin.edit-section', array('id' => $section->id)) }}">{{ Util::clean($section->name) }}</a></li>
        <li><a href="{{ URL::route('admin.edit-category', array('id' => $category->id)) }}">{{ Util::clean($category->name) }}</a></li>
        <li class="active">{{ Util::clean($product->name) }}</a></li>
    </ol>

    <div class="container">
        <h1>{{ Util::clean($product->name) }}</h1>
        {{ View::make('admin.form-product', array('product' => $product, 'images' => $images)) }}
        <a class="btn btn-danger" href="{{ URL::route('admin.delete-product', array('id' => $product->id)) }}" data-confirm="Are you sure you want to delete this product?">Delete</a>
    </div>

@stop