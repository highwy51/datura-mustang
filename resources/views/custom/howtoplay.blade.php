@extends('layouts.app')


@section('title') How To Play @endsection


@section('content')
{!! breadcrumbs(['How To Play' => 'howtoplay']) !!}


@endsection

@section('sidebar')
    @include('howtoplay._sidebar')
@endsection