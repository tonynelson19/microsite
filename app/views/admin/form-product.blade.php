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
    {{ Former::textarea('description')->value($product->description)->rows(8)->class('js-editor') }}
    {{ Former::select('status')->value($product->status)->options(Product::$statuses) }}
    <div class="form-group">
        <label for="name" class="col-lg-2 control-label">Images</label>
        <div class="col-lg-10 controls">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="1%">Order</th>
                        <th width="20%">Image</th>
                        <th width="35%">URL</th>
                        <th width="35%">Caption</th>
                        <th width="8%">Status</th>
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
                            <td>{{ Form::text('newImages[' . $i . '][order]', $order, array('size' => 3)) }}</td>
                            <td>&nbsp;</td>
                            <td>{{ Form::text('newImages[' . $i . '][imageUrl]') }}</td>
                            <td>{{ Form::text('newImages[' . $i . '][caption]') }}</td>
                            <td>{{ Form::select('newImages[' . $i . '][status]', Image::$statuses) }}</td>
                            <td>&nbsp;</td>
                        </tr>
                        <?php $order++; ?>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-lg-2 control-label">Videos</label>
        <div class="col-lg-10 controls">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="1%">Order</th>
                        <th width="20%">Video</th>
                        <th width="35%">URL</th>
                        <th width="35%">Caption</th>
                        <th width="8%">Status</th>
                        <th width="1%">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $order = 1; ?>
                    @foreach ($videos as $video)
                        <tr>
                            <td>{{ Form::text('videos[' . $video->id . '][order]', $order, array('size' => 3)) }}</td>
                            <td><iframe width="120" height="90" src="{{ Video::getYouTubeEmbedUrl($video->videoUrl) }}?wmode=transparent&html5=1" frameborder="0" allowfullscreen></iframe></td>
                            <td>{{ Form::text('videos[' . $video->id . '][videoUrl]', $video->videoUrl) }}</td>
                            <td>{{ Form::text('videos[' . $video->id . '][caption]', $video->caption) }}</td>
                            <td>{{ Form::select('videos[' . $video->id . '][status]', Video::$statuses, $video->status) }}</td>
                            <td>{{ Form::checkbox('videos[' . $video->id . '][delete]') }}</td>
                        </tr>
                        <?php $order++; ?>
                    @endforeach
                    @for ($i = 1; $i <= 5; $i++)
                        <tr>
                            <td>{{ Form::text('newVideos[' . $i . '][order]', $order, array('size' => 3)) }}</td>
                            <td>&nbsp;</td>
                            <td>{{ Form::text('newVideos[' . $i . '][videoUrl]') }}</td>
                            <td>{{ Form::text('newVideos[' . $i . '][caption]') }}</td>
                            <td>{{ Form::select('newVideos[' . $i . '][status]', Video::$statuses) }}</td>
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