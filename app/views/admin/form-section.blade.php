{{ Former::horizontal_open_for_files() }}
    {{ Former::text('order')->value($section->order) }}
    {{ Former::text('name')->value($section->name) }}
    {{ Former::file('imageUpload')->label('Image Upload') }}
    {{ Former::text('imageUrl')->label('Image URL')->value($section->imageUrl) }}
    @if ($section->imageUrl)
        <div class="form-group">
            <label for="name" class="col-lg-2 control-label">Current Image</label>
            <div class="col-lg-10 controls">
                <div class="thumbnail"><img src="{{ $section->imageUrl }}" /></div>
            </div>
        </div>
    @endif
    {{ Former::select('status')->value($section->status)->options(Section::$statuses) }}
    @if ($section->id)
        <div class="form-group">
            <label for="name" class="col-lg-2 control-label">Categories</label>
            <div class="col-lg-10 controls">
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
                        <?php $order = 1; ?>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ Form::text('categories[' . $category->id . ']', $order, array('size' => 3)) }}</td>
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
                            <?php $order++; ?>
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
        </div>
    @endif
    {{ Former::actions()->primary_submit('Submit') }}
    @if ($section->id)
        <a class="btn btn-danger" href="{{ URL::route('admin.delete-section', array('id' => $section->id)) }}" data-confirm="Are you sure you want to delete this section?">Delete</a>
    @endif
{{ Former::close() }}