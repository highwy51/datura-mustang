@extends('layouts.app')


@section('title') Site Navigation @endsection


@section('content')
{!! breadcrumbs(['Site Navigation' => 'howtoplay']) !!}


<div class="card">
    <div class="card-header">
    <h2>Hello</h2>
    </div>
    Hello
</div>

@endsection

@section('sidebar')
    @include('howtoplay._sidebar')
@endsection