{{ Former::horizontal_open_for_files() }}
    {{ Former::text('order')->value($product->order) }}
    {{ Former::text('name')->value($product->name) }}
    @if ($product->imageUrl)
        {{ Former::file('image')->help('<div class="thumbnail"><img src="' . $product->imageUrl . '" /></div>') }}
    @else
        {{ Former::file('image') }}
    @endif
    {{ Former::text('videoUrl')->label('Video URL')->value($product->videoUrl) }}
    {{ Former::textarea('description')->value($product->description)->rows(8) }}
    {{ Former::select('status')->value($product->status)->options(Product::$statuses) }}
    {{ Former::actions()->primary_submit('Submit') }}
{{ Former::close() }}