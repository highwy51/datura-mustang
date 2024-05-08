@extends('layouts.app')


@section('title') Getting Started @endsection


@section('content')
{!! breadcrumbs(['Getting Started' => 'howtoplay']) !!}


<div class="site-page-content parsed-text">
    {!! $page->parsed_text !!}
</div>


@endsection
