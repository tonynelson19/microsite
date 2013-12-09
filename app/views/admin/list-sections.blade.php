@extends('layouts.admin')

@section('content')

    <ol class="breadcrumb">
        <li class="active">Sections</li>
    </ol>

    <div class="container">
        <h1>Sections</h1>
        <a href="{{ URL::route('admin.download-images') }} ">Download Images</a>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="1%">Order</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Categories</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sections as $section)
                    <tr>
                        <td>{{ $section->order }}</td>
                        <td>{{ Util::clean($section->name) }}</td>
                        <td><div class="thumbnail"><img src="{{ $section->imageUrl }}" /></div></td>
                        <td>{{ $section->status }}</td>
                        <td>{{ count($section->categories) }}</td>
                        <td>
                            <ul>
                                <li><a href="{{ URL::route('admin.edit-section', array('id' => $section->id)) }}">Edit</a></li>
                                <li><a href="{{ URL::route('admin.delete-section', array('id' => $section->id)) }}" data-confirm="Are you sure you want to delete this section?">Delete</a></li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
                @if (count($sections) == 0)
                    <tr>
                        <td colspan="6">None</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <a class="btn" href="{{ URL::route('admin.add-section') }}">Add Section</a>
    </div>

@stop