@extends('admin::layout')

@section('title', $title)
 <div class="row">
@section('content')
   

        <div class="col-md-10">
            <div class="panel panel-flat">
                <div class="panel-heading">
				    <h6 class="panel-title">{{ $title }}</h5>  
                </div>
                <div class="panel-body">
                        @include('admin::page.gid.__form')
                 
                   
                   
                </div>
            </div>
        </div>
		@endsection
		
           	@section('left_lang')
        <div class="col-md-2">  
            @include('admin::left_lang',$sys_lang)
		</div>
		@endsection
	
