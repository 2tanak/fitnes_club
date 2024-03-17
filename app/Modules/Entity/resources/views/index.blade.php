@extends('entity::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('entity.name') !!}</p>
@endsection
