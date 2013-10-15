@extends('layouts.admin')

@section('content')

    <ol class="breadcrumb">
        <li><a href="{{ URL::route('admin.list-sections') }} ">Sections</a></li>
        <li><a href="{{ URL::route('admin.edit-section', array('id' => $section->id)) }}">{{ Util::clean($section->name) }}</a></li>
        <li class="active">{{ Util::clean($category->name) }}</a></li>
    </ol>

    <div class="container">
        <h1>{{ Util::clean($category->name) }}</h1>
        {{ View::make('admin.form-category', array('category' => $category)) }}
        <a class="btn btn-danger" href="{{ URL::route('admin.delete-category', array('id' => $category->id)) }}" data-confirm="Are you sure you want to delete this category?">Delete</a>
        <h2>Products</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="1%">Order</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Images</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->order }}</td>
                        <td>{{ Util::clean($product->name) }}</td>
                        <td>{{ $product->status }}</td>
                        <td><div class="thumbnail"><img src="{{ $product->imageUrl }}" /></div></td>
                        <td>{{ count($product->images) }}</td>
                        <td>
                            <ul>
                                <li><a href="{{ URL::route('admin.edit-product', array('id' => $product->id)) }}">Edit</a></li>
                                <li><a href="{{ URL::route('admin.delete-product', array('id' => $product->id)) }}" data-confirm="Are you sure you want to delete this product?">Delete</a></li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
                @if (count($products) == 0)
                    <tr>
                        <td colspan="6">None</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <a class="btn" href="{{ URL::route('admin.add-product', array('id' => $category->id)) }}">Add Product</a>
    </div>

@stop