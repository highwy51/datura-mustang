@if($breedingPermission)
    {!! Form::open(['url' => $breedingPermission->id ? 'character/'.$character->slug.'/breeding-permissions/'.$breedingPermission->id : 'character/'.$character->slug.'/breeding-permissions/new']) !!}

    <div class="form-group">
        {!! Form::label('recipient_id', 'Recipient') !!} {!! add_help('Note that observed offspring may also be transferred by the recipient upon receipt.') !!}
        {!! Form::select('recipient_id', $userOptions, $breedingPermission->recipient_id, ['class' => 'form-control', 'placeholder' => 'Select a Recipient', 'id' => 'recipientField']) !!}
    </div>

    <div class="form-group">
    {!! Form::hidden('type', 'Full') !!}
</div>

    <div class="form-group">
        {!! Form::label('description', 'Notes (Optional)') !!}
        {!! add_help('Enter any additional notes you would like to attach to this offspring observation.') !!}
        {!! Form::textarea('description', $breedingPermission->description, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group text-right">
        {!! Form::submit($breedingPermission->id ? 'Edit' : 'Create', ['class' => 'btn btn-success']) !!}
    </div>

    {!! Form::close() !!}

    <script>
        $(document).ready(function() {
            $('#recipientField').selectize();
        });
    </script>
@else
    <p>Invalid offspring observation selected.</p>
@endif
