<div class="row world-entry">
    @if ($imageUrl)
        <div class="col-md-3 world-entry-image"><a href="{{ $imageUrl }}" data-lightbox="entry" data-title="{{ $name }}"><img src="{{ $imageUrl }}" class="world-entry-image" /></a></div>
    @endif
    <div class="{{ $imageUrl ? 'col-md-9' : 'col-12' }}">
        @if (isset($edit))
            <x-admin-edit title="{{ $edit['title'] }}" :object="$edit['object']" />
        @endif
        <h3>{!! $name !!} @if (isset($searchUrl) && $searchUrl)
                <a href="{{ $searchUrl }}" class="world-entry-search text-muted"><i class="fas fa-search"></i></a>
            @endif
        </h3>
        @if ($category->is_character_owned == 1)
            <div><strong>Characters can own {{ $category->character_limit != 0 ? $category->character_limit : '' }} skills in this category{{ $category->can_name != 0 ? ', as well as name them' : '' }}!</strong></div>
        @endif
        <div class="world-entry-text">
            {!! $description !!}
        </div>
    </div>
</div>
