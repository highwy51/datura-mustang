@if ($characters->count())
    <div class="row">
        @foreach ($characters as $character)
            <div class="col-md-3 col-6 text-center mb-2">
                <div>
                @if(isset($character->image))
                        <a href="{{ $character->url }}"><img src="{{ $character->image->thumbnailUrl }}" class="img-thumbnail" alt="{{ $character->fullName }}" /></a>
                @endif
                </div>
                <div class="mt-1">
                    <a href="{{ $character->url }}" class="h5 mb-0">
                        @if (!$character->is_visible)
                            <i class="fas fa-eye-slash"></i>
                        @endif {{ Illuminate\Support\Str::limit($character->fullName, 20, $end = '...') }}
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p>No {{ $myo ? 'MYO slots' : 'characters' }} found.</p>
@endif
