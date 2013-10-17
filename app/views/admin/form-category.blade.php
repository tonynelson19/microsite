{{ Former::horizontal_open_for_files() }}
    {{ Former::text('order')->value($category->order) }}
    {{ Former::text('name')->value($category->name) }}
    {{ Former::select('status')->value($category->status)->options(Category::$statuses) }}
    @if ($category->id)
        <div class="form-group">
            <label for="name" class="col-lg-2 control-label">Products</label>
            <div class="col-lg-10 controls">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="1%">Order</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Images</th>
                            <th>Videos</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $order = 1; ?>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ Form::text('products[' . $product->id . ']', $order, array('size' => 3)) }}</td>
                                <td>{{ Util::clean($product->name) }}</td>
                                <td><div class="thumbnail"><img src="{{ $product->imageUrl }}" /></div></td>
                                <td>{{ $product->status }}</td>
                                <td>{{ count($product->images) }}</td>
                                <td>{{ count($product->videos) }}</td>
                                <td>
                                    <ul>
                                        <li><a href="{{ URL::route('admin.edit-product', array('id' => $product->id)) }}">Edit</a></li>
                                        <li><a href="{{ URL::route('admin.delete-product', array('id' => $product->id)) }}" data-confirm="Are you sure you want to delete this product?">Delete</a></li>
                                    </ul>
                                </td>
                            </tr>
                            <?php $order++; ?>
                        @endforeach
                        @if (count($products) == 0)
                            <tr>
                                <td colspan="7">None</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <a class="btn" href="{{ URL::route('admin.add-product', array('id' => $category->id)) }}">Add Product</a>
            </div>
        </div>
    @endif
    {{ Former::actions()->primary_submit('Submit') }}
{{ Former::close() }}