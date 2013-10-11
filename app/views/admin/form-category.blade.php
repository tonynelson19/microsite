{{ Former::horizontal_open_for_files() }}
    {{ Former::text('order')->value($category->order) }}
    {{ Former::text('name')->value($category->name) }}
    {{ Former::select('status')->value($category->status)->options(Category::$statuses) }}
    {{ Former::actions()->primary_submit('Submit') }}
{{ Former::close() }}