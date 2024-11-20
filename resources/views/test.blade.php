@extends('layouts.master')
@section('content')
    @foreach($htmlArray as $html)
        {!! $html !!}
    @endforeach
@endsection
