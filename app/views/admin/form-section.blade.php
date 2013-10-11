{{ Former::horizontal_open_for_files() }}
    {{ Former::text('order')->value($section->order) }}
    {{ Former::text('name')->value($section->name) }}
    @if ($section->imageUrl)
        {{ Former::file('image')->help('<div class="thumbnail"><img src="' . $section->imageUrl . '" /></div>') }}
    @else
        {{ Former::file('image') }}
    @endif
    {{ Former::select('status')->value($section->status)->options(Section::$statuses) }}
    {{ Former::actions()->primary_submit('Submit') }}
{{ Former::close() }}