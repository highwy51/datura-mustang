@extends('character.design.layout')

@section('design-title')
    Request (#{{ $request->id }}) :: Comments
@endsection

@section('design-content')
    {!! breadcrumbs(['Design Approvals' => 'designs', 'Request (#' . $request->id . ')' => 'designs/' . $request->id, 'Comments' => 'designs/' . $request->id . '/comments']) !!}

    @include('character.design._header', ['request' => $request])

    <h2>Comments</h2>

    @if ($request->status == 'Draft' && $request->user_id == Auth::user()->id)
        <p>
            <b>Tracking Request Form</b>
            <br>
            Tracked Name:
            <br>
            Height:
            <br>
             <small>-Please use a lore-accurate height that suits the sub-breed of your character.</small>
        </p>
        {!! Form::open(['url' => 'designs/' . $request->id . '/comments']) !!}
        <div class="form-group">
            {!! Form::label('Comments') !!}
            {!! Form::textarea('comments', $request->comments, ['class' => 'form-control']) !!}
        </div>
        <div class="text-right">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    @else
        <div class="card">
            <div class="card-body">
                {!! nl2br(htmlentities($request->comments)) !!}
            </div>
        </div>
    @endif
@endsection
