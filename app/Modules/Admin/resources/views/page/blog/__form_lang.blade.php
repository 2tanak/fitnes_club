@php
use Illuminate\Support\Facades\DB;


$route = Route::currentRouteName();
$ar = explode('_',$route);
$page = false;
if(in_array('show',$ar)){
	$page = true;
}


$categories = DB::table('lib_gid_speacialisations')->get();
@endphp








<div>  
 
<label for="title"><b>Имя</b></label> 
<input {{$page ? 'disabled': ''}} type="text" 
@if(isset(Session::get('old')['imya']))
	value="{{Session::get('old')['imya']}}" 
@else
value='{{$model->imya ? $model->imya : ''}}' 
@endif
name='imya' placeholder="Имя(текст)" class="form-control"></input>
@if ($errors->has('imya'))
  <span class="help-block">
     <strong style='color:#a94442'>{{ $errors->first('imya') }}</strong>
   </span>
@endif
</div>

<br><br>

<div>
<label for="title"><b>Валюта или тенге</b></label> 
<input {{$page ? 'disabled': ''}} type="text" 
 @if(old('imya'))
  value="{{old('currency')}}"
@else
value="{{$model->currency ? $model->currency : old('currency')}}"
@endif
name='currency' placeholder="Имя(текст)" class="form-control"></input>
@if ($errors->has('currency'))
  <span class="help-block">
     <strong style='color:#a94442'>{{ $errors->first('currency') }}</strong>
   </span>
@endif
</div>



@if($model->relUsers->type_id == 2)
	
<div>  
<label for="title"><b>Фамилия</b></label> 
<input {{$page ? 'disabled': ''}} type="text" 
@if(old('family'))
	value="{{old('family')}}" 
@else
	value="{{isset($model->family) ? $model->family : ''}}" 
@endif
name='family' placeholder="Фамилия(текст)" class="form-control"></input>
@if ($errors->has('family'))
  <span class="help-block">
     <strong style='color:#a94442'>{{ $errors->first('family') }}</strong>
   </span>
@endif
</div>

@endif















<br><br>
<div>  
<label for="title"><b>Заголовок на детальной</b></label> 
<input {{$page ? 'disabled': ''}} type="text" 
@if(old('gid_title'))
	value="{{old('gid_title')}}" 
@else
	value="{{isset($model->gid_title) ? $model->gid_title : ''}}" 
@endif
name='gid_title' placeholder="Туроператор или Гид" class="form-control"></input>
@if ($errors->has('gid_title'))
  <span class="help-block">
     <strong style='color:#a94442'>{{ $errors->first('gid_title') }}</strong>
   </span>
@endif
</div>

<br><br>


<div>  
 <label for="title"><b>Тип гида</b></label> 
<input {{$page ? 'disabled': ''}} type="text" 

@if(isset(Session::get('old')['name']))
	value="{{Session::get('old')['name']}}" 
@else
value='{{isset($model->name) ? $model->name : ''}}' 
@endif
name='name' placeholder="{{$page ? '': 'Туристический гид(текст)'}}" class="form-control"></input>
@if ($errors->has('name'))
  <span class="help-block">
     <strong style='color:#a94442'>{{ $errors->first('name') }}</strong>
   </span>
@endif
</div>



<br><br>


<div>  
<label for="text"><b>Текст</b></label> 
<textarea {{$page ? 'disabled': ''}} 
name='description'
rows="14" 
cols="4" 
id="editor"
class="{{$page ? 'form-control' : 'form-control'}} ">
@if(isset(Session::get('old')['description']))
{{Session::get('old')['description']}}
@else
{{isset($model->description) ? $model->description : ''}}
@endif
</textarea>
</div>


@if(RoleService::getRole(Auth::user()->type_id) !='GID'  || RoleService::getRole(Auth::user()->type_id) !='TYROPERATOR')
<br><br>

<div>
 <label for="title"><b>SEO-TITLE</b></label> 
<input {{$page ? 'disabled': ''}} type="text" 
value='{{isset($model->seo_title) ? $model->seo_title : ''}}' name='seo_title' placeholder="(текст)" class="form-control"></input>
@if ($errors->has('name'))
  <span class="help-block">
     <strong style='color:#a94442'>{{ $errors->first('name') }}</strong>
   </span>
@endif
</div>


<br><br>

<div>
 <label for="text"><b>SEO-DESCRIPTION</b></label> 
<textarea {{$page ? 'disabled': ''}}  
value='' name='seo_description'  class="form-control {{$page ? '' : 'wysihtml5 wysihtml5-default'}}">
{{isset($model->seo_description) ? $model->seo_description : ''}}</textarea>
</div>
@endif
<script>
  CKEDITOR.replace('editor', {
  //filebrowserUploadUrl: "{{route('aboutseditor')}}",
  //disallowedContent: 'a[href]',
  height: 300, });
    CKEDITOR.config.removePlugins = 'image';

</script>
