@extends('admin::layouts.master')

@section('title', $title)

@section('content')
<div class="row">
<div class="panel panel-flat">
    <div class="panel-heading">
       <h6 class="panel-title">{{ $title }}</h6>
         </div>
		    <div class='wrapper-ajax'>
				<table class="table table-togglable">
				<thead>
					<tr>
						<th >id</th>
						<th >photo</th>
						<th >name</th>
						<th >description</th>
						
					 <th width="150">
				
							<a href="{{ route($route_path.'_create') }}"  
							class="btn btn-sm  bg-success"
							style="width:150px;"
							>Add</a>
						
							
							 
						</th>
					</tr>
					</thead>
					<tbody>
					@foreach ($items as $i)
						<tr>
							<td>{{ $i->id }}</td>
							<td>фото</td>
							<td>{{$i->name }}</td>
							<td>{!! $i->the_excerpt($i->description) !!}</td>
							
							<td>
							
								<div class="btn-group">
									<button type="button" class="btn  btn-primary btn-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										<i class="icon-menu7"></i> 
									</button>
									<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="{{ route($route_path.'_update_save', $i) }}">Change</a></li>
                                   <li class="divider"></li>
										<li><a href="{{ route($route_path.'_delete', $i) }}">Delete</a></li>
									</ul>
									
								</div>
								
						
							</td>
							</tr>
							@endforeach
					</tbody>
					
			       </table>
             </div>
			 <div class="panel-footer text-right">

			</div>
 </div>
</div>
@endsection