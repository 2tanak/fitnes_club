@extends('grafika::layouts.master')
@section('content')
<div id="app">

<test2-component :url="{{json_encode($arr)}}"></test2-component>
</div>

@endsection
