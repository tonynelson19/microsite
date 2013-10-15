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
    {{ Former::actions()->primary_submit('Submit') }}
{{ Former::close() }}