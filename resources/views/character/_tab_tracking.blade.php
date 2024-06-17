<div class="container text-center">
    @if ($character->category->name == 'Tracked')
        <h5>{{ $character->fullName }} is being tracked</h5>


    @else
        <h5>No tracking info found</h5>
    @endif
</div>


@if (Auth::check() && Auth::user()->hasPower('manage_characters'))
    <div class="mt-3">
        <a href="#" class="btn btn-outline-info btn-sm edit-tracking" data-{{ $character->is_myo_slot ? 'id' : 'slug' }}="{{ $character->is_myo_slot ? $character->id : $character->slug }}"><i class="fas fa-cog"></i> Edit</a>
    </div>
@endif
