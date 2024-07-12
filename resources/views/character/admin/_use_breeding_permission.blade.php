@if($breedingPermission)
    {!! Form::open(['url' => 'admin/character/'.$character->slug.'/breeding-permissions/'.$breedingPermission->id.'/use']) !!}

    <p>
        This will mark this offspring as birthed. This is not reversible. Are you sure you want to mark this offspring as birthed?
    </p>

    <div class="form-group text-right">
        {!! Form::submit('Mark Birthed', ['class' => 'btn btn-success']) !!}
    </div>

    {!! Form::close() !!}
@else
    <p>Invalid offspring observation selected.</p>
@endif
