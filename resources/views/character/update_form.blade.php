@extends('character.layout', ['isMyo' => $character->is_myo_slot])

@section('profile-title')
    {{ $character->is_myo_slot ? 'MYO Approval' : 'Design Update' }} for {{ $character->fullName }}
@endsection

@section('meta-img')
    {{ $character->image->thumbnailUrl }}
@endsection

@section('profile-content')
    @if ($character->is_myo_slot)
        {!! breadcrumbs(['MYO Slot Masterlist' => 'myos', $character->fullName => $character->url, $character->is_myo_slot ? 'MYO Approval' : 'Design Update' => $character->url . '/approval']) !!}
    @else
        {!! breadcrumbs([
            $character->category->masterlist_sub_id ? $character->category->sublist->name . ' Masterlist' : 'Character masterlist' => $character->category->masterlist_sub_id ? 'sublist/' . $character->category->sublist->key : 'masterlist',
            $character->fullName => $character->url,
            $character->is_myo_slot ? 'MYO Approval' : 'Design Update' => $character->url . '/approval',
        ]) !!}
    @endif

    @include('character._header', ['character' => $character])

    <h3>
        Track Horse
    </h3>
    @if (!$queueOpen)
        <div class="alert alert-danger">
            The {{ $character->is_myo_slot ? 'MYO approval' : 'tracking' }} queue is currently closed. You cannot submit a new approval request at this time.
        </div>
    @elseif(!$request)
        <p>No {{ $character->is_myo_slot ? 'MYO approval' : 'tracking' }} request found. Would you like to create one?</p>
        <p>This will prepare a request to approve {{ $character->is_myo_slot ? 'your MYO slot\'s tracker' : 'a tracker for your datura' }}, which will allow you to upload a personal tracking image, choose a name, and use foal slots for this character. You will be able to edit the contents of your request as much as you like before submission. Staff will be able to view the draft and provide feedback. </p>
        {!! Form::open(['url' => $character->is_myo_slot ? 'myo/' . $character->id . '/approval' : 'character/' . $character->slug . '/approval']) !!}
        <div class="text-right">
            {!! Form::submit('Create Request', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    @else
        <p>You have a {{ $character->is_myo_slot ? 'MYO approval' : 'tracking' }} request {{ $request->status == 'Draft' ? 'that has not been submitted' : 'awaiting approval' }}. <a href="{{ $request->url }}">Click here to view
                {{ $request->status == 'Draft' ? 'and edit ' : '' }}it.</a></p>
    @endif
@endsection

@section('scripts')
    @parent
    @include('widgets._image_upload_js')
    <script>
        $(document).ready(function() {});
    </script>
@endsection
