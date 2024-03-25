@php
$route = Route::currentRouteName();
$ar = explode('_',$route);
$page = false;
if(in_array('show',$ar)){
	$page = true;
}
@endphp


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
id="editor"  
value='' name='seo_description'  class="form-control {{$page ? '' : ''}}">
{{isset($model->seo_description) ? $model->seo_description : ''}}</textarea>
</div>
<input name='general' value='1' type="hidden">

<script>
  CKEDITOR.replace('editor', {
  //filebrowserUploadUrl: "{{route('aboutseditor')}}",
  //disallowedContent: 'a[href]',
  height: 300, });
    CKEDITOR.config.removePlugins = 'image';

</script>
