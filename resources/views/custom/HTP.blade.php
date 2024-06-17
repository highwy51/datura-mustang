extends('layouts.app')


@section('title') How To Play @endsection


@section('content')
{!! breadcrumbs(['How To Play' => 'HTP']) !!}


<div class="site-page-content parsed-text">
    {!! $page->parsed_text !!}
</div>


@endsection
