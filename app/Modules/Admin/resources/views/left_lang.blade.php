 <div id="accordion">

@foreach ($sys_lang->getAr() as $k => $v) 
<div class="card card-primary card-outline">

                    <a class="d-block w-100" data-toggle="collapse" href="#{{$k}}">
                        <div class="card-header">
                            <h4 class="card-title w-100" style='color:black'>
							{{$v}}
							   
                            </h4>
                        </div>
                    </a>
                    <div id="{{$k}}" class="collapse {{$k=='ru' ? 'show' : ''}}" data-parent="#accordion">
                        <div class="card-body">
						<ul style='list-style:none'>
						   <li>
                             <a href="{{ route($route_path.'_update', $model) }}?lang={{ $k }}" >
							
						       @lang('main.update')</a>
							    <img class='amesome' src ="/amesome/fas_fa-pencil-alt.svg"/>
							</li>
						 </ul>
                        </div>
                    </div>
                </div>
  @endforeach
             </div>