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
        {{ View::make('admin.form-product', array('product' => $product)) }}
        <a class="btn btn-danger" href="{{ URL::route('admin.delete-product', array('id' => $product->id)) }}" data-confirm="Are you sure you want to delete this product?">Delete</a>
        <h2>Images</h2>
        <form method="post" action="{{ URL::route('admin.save-product-images', array('id' => $product->id)) }}">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="1%">Order</th>
                        <th>Image</th>
                        <th>URL</th>
                        <th>Caption</th>
                        <th>Status</th>
                        <th width="1%">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $order = 1; ?>
                    @foreach ($images as $image)
                        <tr>
                            <td>{{ Form::text('images[' . $image->id . '][order]', $order, array('size' => 3)) }}</td>
                            <td><div class="thumbnail"><img src="{{ $image->imageUrl }}" /></div></td>
                            <td>{{ Form::text('images[' . $image->id . '][imageUrl]', $image->imageUrl) }}</td>
                            <td>{{ Form::text('images[' . $image->id . '][caption]', $image->caption) }}</td>
                            <td>{{ Form::select('images[' . $image->id . '][status]', Image::$statuses, $image->status) }}</td>
                            <td>{{ Form::checkbox('images[' . $image->id . '][delete]') }}</td>
                        </tr>
                        <?php $order++; ?>
                    @endforeach
                    @for ($i = 1; $i <= 5; $i++)
                        <tr>
                            <td>{{ Form::text('new[' . $i . '][order]', $order, array('size' => 3)) }}</td>
                            <td>&nbsp;</td>
                            <td>{{ Form::text('new[' . $i . '][imageUrl]') }}</td>
                            <td>{{ Form::text('new[' . $i . '][caption]') }}</td>
                            <td>{{ Form::select('new[' . $i . '][status]', Image::$statuses) }}</td>
                            <td>&nbsp;</td>
                        </tr>
                        <?php $order++; ?>
                    @endfor
                </tbody>
            </table>
            <input type="submit" class="btn btn-primary" value="Submit" />
        </form>
    </div>

@stop