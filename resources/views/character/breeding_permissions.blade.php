@extends('character.layout', ['isMyo' => $character->is_myo_slot])

@section('profile-title') {{ $character->fullName }} @endsection

@section('meta-img') {{ $character->image->thumbnailUrl }} @endsection

@section('profile-content')
@if($character->is_myo_slot)
{!! breadcrumbs(['MYO Slot Masterlist' => 'myos', $character->fullName => $character->url]) !!}
@else
{!! breadcrumbs([($character->category->masterlist_sub_id ? $character->category->sublist->name.' Masterlist' : 'Character masterlist') => ($character->category->masterlist_sub_id ? 'sublist/'.$character->category->sublist->key : 'masterlist' ), $character->fullName => $character->url]) !!}
@endif

@include('character._header', ['character' => $character])

@if(Auth::check() && (Auth::user()->id == $character->user_id))
    <div class="text-right mb-4">
        <a href="#" class="btn btn-success create-breeding-permission">Create New Slot</a>
    </div>
@endif

<p>
    This character has {{ $character->availableBreedingPermissions }} out of {{ $character->maxBreedingPermissions }} maximum observed offspring{{ $character->availableBreedingPermissions == 1 ? '' : 's' }} available.
    @if(Auth::check() && (Auth::user()->id == $character->user_id))
        As the character's owner, you may grant other users up to this many observed offspring. Other users may see how many of this character's observed offspring have been used, and to whom they have been granted.
    @else
        Only the character's owner can create and distribute observed offspring spots.
    @endif
</p>

@if($permissions->count())
    {!! $permissions->render() !!}

    @foreach($permissions as $permission)
        @include('character._breeding_permission', ['isCharacter' => true])
    @endforeach

    {!! $permissions->render() !!}
@else
    <p>No offspring found.</p>
@endif

@endsection

@section('scripts')
    @parent
    @include('character._breeding_permissions_js')
@endsection
