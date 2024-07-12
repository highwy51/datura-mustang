@if($breedingPermission)
    {!! Form::open(['url' => 'admin/character/'.$character->slug.'/breeding-permissions/'.$breedingPermission->id.'/delete']) !!}

    <p>
        This will delete this offspring observation permanently. Are you sure you want to delete?
    </p>

    <div class="form-group text-right">
        {!! Form::submit('Delete', ['class' => 'btn btn-success']) !!}
    </div>

    {!! Form::close() !!}
@else
  <p> Invalid offspring observation selected.</p>
@endif