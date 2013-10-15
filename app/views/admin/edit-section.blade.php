@extends('layouts.admin')

@section('content')

    <ol class="breadcrumb">
        <li><a href="{{ URL::route('admin.list-sections') }} ">Sections</a></li>
        <li class="active">{{ Util::clean($section->name) }}</li>
    </ol>

    <div class="container">
        <h1>{{ Util::clean($section->name) }}</h1>
        {{ View::make('admin.form-section', array('section' => $section)) }}
        <a class="btn btn-danger" href="{{ URL::route('admin.delete-section', array('id' => $section->id)) }}" data-confirm="Are you sure you want to delete this section?">Delete</a>
        <h2>Categories</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="1%">Order</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Products</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->order }}</td>
                        <td>{{ Util::clean($category->name) }}</td>
                        <td>{{ $category->status }}</td>
                        <td>{{ count($category->products) }}</td>
                        <td>
                            <ul>
                                <li><a href="{{ URL::route('admin.edit-category', array('id' => $category->id)) }}">Edit</a></li>
                                <li><a href="{{ URL::route('admin.delete-category', array('id' => $category->id)) }}" data-confirm="Are you sure you want to delete this category?">Delete</a></li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
                @if (count($categories) == 0)
                    <tr>
                        <td colspan="5">None</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <a class="btn" href="{{ URL::route('admin.add-category', array('id' => $section->id)) }}">Add Category</a>
    </div>

@stop