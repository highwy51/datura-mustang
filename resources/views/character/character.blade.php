@extends('character.layout', ['isMyo' => $character->is_myo_slot])

@section('profile-title')
    {{ $character->fullName }}
@endsection

@section('meta-img')
    {{ $character->image->thumbnailUrl }}
@endsection

@section('profile-content')
    @if ($character->is_myo_slot)
        {!! breadcrumbs(['MYO Slot Masterlist' => 'myos', $character->fullName => $character->url]) !!}
    @else
        {!! breadcrumbs([
            $character->category->masterlist_sub_id ? $character->category->sublist->name . ' Masterlist' : 'Character masterlist' => $character->category->masterlist_sub_id ? 'sublist/' . $character->category->sublist->key : 'masterlist',
            $character->fullName => $character->url,
        ]) !!}
    @endif

    @include('character._header', ['character' => $character])

    {{-- Main Image --}}
    <div class="row mb-3">
        <div class="col-md-7">
            <div class="text-center">
                <a href="{{ $character->image->canViewFull(Auth::check() ? Auth::user() : null) && file_exists(public_path($character->image->imageDirectory . '/' . $character->image->fullsizeFileName)) ? $character->image->fullsizeUrl : $character->image->imageUrl }}"
                    data-lightbox="entry" data-title="{{ $character->fullName }}">
                    <img src="{{ $character->image->canViewFull(Auth::check() ? Auth::user() : null) && file_exists(public_path($character->image->imageDirectory . '/' . $character->image->fullsizeFileName)) ? $character->image->fullsizeUrl : $character->image->imageUrl }}"
                        class="image" alt="{{ $character->fullName }}" />
                </a>
            </div>
            @if ($character->image->canViewFull(Auth::check() ? Auth::user() : null) && file_exists(public_path($character->image->imageDirectory . '/' . $character->image->fullsizeFileName)))
                <div class="text-right">You are viewing the full-size image. <a href="{{ $character->image->imageUrl }}">View watermarked image</a>?</div>
            @endif
        </div>
        @include('character._image_info', ['image' => $character->image])
    </div>

    {{-- Info --}}
    <div class="card character-bio">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                @if ($character->getLineageBlacklistLevel() < 2)   
                    <li class="nav-item">
                        <a class="nav-link active" id="lineageTab" data-toggle="tab" href="#lineage" role="tab">Lineage</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" id="trackingTab" data-toggle="tab" href="#tracking" role="tab">Tracking</a>
                </li>
                @if (Auth::check() && Auth::user()->hasPower('manage_characters'))
                    <li class="nav-item">
                        <a class="nav-link" id="settingsTab" data-toggle="tab" href="#settings-{{ $character->slug }}" role="tab"><i class="fas fa-cog"></i></a>
                    </li>
                @endif
            </ul>
        </div>
        <div class="card-body tab-content">
            @if ($character->getLineageBlacklistLevel() < 2)
                <div class="tab-pane fade show active" id="lineage">
                    @include('character._tab_lineage', ['character' => $character])
                </div>
            @endif
            <div class="tab-pane fade" id="tracking">
                    @include('character._tab_tracking', ['character' => $character])
            </div>
            <div class="tab-pane fade" id="notes">
                @include('character._tab_notes', ['character' => $character])
            </div>
            <div class="tab-pane fade" id="skills">
                @include('character._tab_skills', ['character' => $character, 'skills' => $skills])
            </div>
            @if (Auth::check() && Auth::user()->hasPower('manage_characters'))
                <div class="tab-pane fade" id="settings-{{ $character->slug }}">
                    {!! Form::open(['url' => $character->is_myo_slot ? 'admin/myo/' . $character->id . '/settings' : 'admin/character/' . $character->slug . '/settings']) !!}
                    <div class="form-group">
                        {!! Form::checkbox('is_visible', 1, $character->is_visible, ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
                        {!! Form::label('is_visible', 'Is Visible', ['class' => 'form-check-label ml-3']) !!} {!! add_help('Turn this off to hide the character. Only mods with the Manage Masterlist power (that\'s you!) can view it - the owner will also not be able to see the character\'s page.') !!}
                    </div>
                    @if (Auth::check() && Auth::user()->hasPower('manage_characters'))
                        <div class="mt-3">
                            <a href="#" class="btn btn-outline-info btn-sm edit-stats" data-{{ $character->is_myo_slot ? 'id' : 'slug' }}="{{ $character->is_myo_slot ? $character->id : $character->slug }}"><i class="fas fa-cog"></i> Edit Stats</a>
                        </div>
                    @endif
                    <div class="text-right">
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                    <hr />
                    <div class="text-right">
                        <a href="#" class="btn btn-outline-danger btn-sm delete-character" data-slug="{{ $character->slug }}">Delete Character</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    @include('character._image_js', ['character' => $character])
@endsection
