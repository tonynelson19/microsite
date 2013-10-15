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
    {{ Former::actions()->primary_submit('Submit') }}
{{ Former::close() }}