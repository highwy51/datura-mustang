@extends('character.layout', ['isMyo' => $character->is_myo_slot])

@section('profile-title')
    {{ $character->fullName }}'s Age
@endsection

@section('profile-content')
    {!! breadcrumbs([
        $character->category->masterlist_sub_id ? $character->category->sublist->name . ' Masterlist' : 'Character masterlist' => $character->category->masterlist_sub_id ? 'sublist/' . $character->category->sublist->key : 'masterlist',
        $character->fullName => $character->url,
        'Stats' => $character->url . '/stats',
    ]) !!}

    <h1>
        <a href="{{ $character->url }}">{!! $character->fullName !!}'s</a> Character Age Info
    </h1>
    <p>
        Here you can view {!! $character->fullName !!}'s age information.
    </p>

    @include('widgets._level_info', ['level' => $character->level])

    <div class="text-right mb-4">
        <a href="{{ url($character->url . '/stats/logs') }}">View Logs...</a>
    </div>
@endsection
@section('scripts')
    <script>
        $('document').ready(function() {
            $('.stat-entry').on('click', function() {
                var id = $(this).data('id');
                loadModal("{{ url('character/' . $character->slug . '/stats') }}/" + id);
            });
        });
    </script>
@endsection
