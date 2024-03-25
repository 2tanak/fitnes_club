<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Admin Module - {{ config('app.name', 'Laravel') }}</title>


    <meta name="description" content="{{ $description ?? '' }}">
    <meta name="keywords" content="{{ $keywords ?? '' }}">
    <meta name="author" content="{{ $author ?? '' }}">

    <!-- Fonts -->
	
	
   

	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="/admin-asset/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="/admin-asset/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="/admin-asset/assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="/admin-asset/assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="/admin-asset/assets/css/colors.css" rel="stylesheet" type="text/css">
	
	<link href="/admin-asset/assets/custom.css" rel="stylesheet" type="text/css">
	
	<link rel="stylesheet" href="/admin-asset/drobsone/css/style.css">
    <link rel="stylesheet" href="/admin-asset/drobsone/css/dropzone.css">

    {{-- Vite CSS --}}
    {{ module_vite('build-admin', 'resources/assets/sass/app.scss') }} 
</head>
@section('css_block')
    @show
<body>
@include('admin::__block.main_navbar')
<div class="page-container">
	<div class="page-content">
	   @include('admin::__block.sidebar')
	   <div class="content-wrapper">
	   @include('admin::__block.page_header')
	    @include('sweetalert::alert')
	       <div class="content">
		       @yield('content')
					@yield('left_lang')
                    
		   </div>
	   </div>
	</div>
</div>
 @include('admin::__block.footer')
</body>
