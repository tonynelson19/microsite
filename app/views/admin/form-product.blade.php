{{ Former::horizontal_open_for_files() }}
    {{ Former::text('order')->value($product->order) }}
    {{ Former::text('name')->value($product->name) }}
    {{ Former::file('imageUpload')->label('Thumbnail Upload') }}
    {{ Former::text('imageUrl')->label('Thumbnail URL')->value($product->imageUrl) }}
    @if ($product->imageUrl)
        <div class="form-group">
            <label for="name" class="col-lg-2 control-label">Current Thumbnail</label>
            <div class="col-lg-10 controls">
                <div class="thumbnail"><img src="{{ $product->imageUrl }}" /></div>
            </div>
        </div>
    @endif
    {{ Former::text('videoUrl')->label('Video URL')->value($product->videoUrl) }}
    @if ($product->videoUrl)
        <div class="form-group">
            <label for="name" class="col-lg-2 control-label">&nbsp</label>
            <div class="col-lg-10 controls">
                <iframe width="420" height="315" src="//www.youtube.com/embed/{{ Product::getVideoId($product->videoUrl) }}" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    @endif
    {{ Former::textarea('description')->value($product->description)->rows(8)->class('js-editor') }}
    {{ Former::select('status')->value($product->status)->options(Product::$statuses) }}

    <div class="form-group">
        <label for="name" class="col-lg-2 control-label">Images</label>
        <div class="col-lg-10 controls">
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
        </div>
    </div>

    {{ Former::actions()->primary_submit('Submit') }}
{{ Former::close() }}