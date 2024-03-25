@extends('admin::layouts.master')
@section('title', $title)
@section('content')
<br>
<div class='row'>
    <div class="col-md-9">
        <div class="panel-body">


            <form action="{{ route($route_path.'_update_save', $model) }}" method="post" enctype="multipart/form-data" class="need_validate_form " novalidate>
                @include('admin::page.'.$rout.'.__form')
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="lang" value="{{ app()->getLocale() }}">
                <button type="submit" class="btn btn-primary pull-left">Update</button>

            </form>

        </div>
    </div>

@php

@endphp
    <div class="col-md-3">
       @include('admin::left_lang',$sys_lang)
    </div>
</div>
@endsection