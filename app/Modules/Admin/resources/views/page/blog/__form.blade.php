<div>

  <label><b>Photo</b></label>
  <input type="file" value="{{$model->img}}" name='photo' placeholder="Фото" class="form-control" />
  @if (isset($model->files->id))
  уже загружено <a href="{{Storage::disk('public')->url($model->files->small)}}" target="_blank">просмотреть</a>
  @else
  Photo no upload
  @endif
</div>

<br><br>

<div>
  <label for="name"><b>Title</b></label>
  <input type="text" class="form-control" id="name" placeholder="заголовок" name="name" value="
   {{isset($model->name) ? $model->name: old('text')}}
   ">
  @if ($errors->has('name'))
  <span class="help-block">
    <strong style='color:#a94442'>{{ $errors->first('name') }}</strong>
  </span>
  @endif
</div>



<br><br>
<div>

  <p><b>Publish</b></p>
  <select name="publish" class="form-control">
    <option {{ $model->publish == 1 ? 'selected' : '' }} value="1">
	published
	</option>
    <option {{ $model->publish == 0 ? 'selected' : '' }} value="0">
	 not published
	</option>


  </select>
</div>




<br><br>
<div>
  @if ($errors->has('description'))
  <span class="help-block">
    <strong style='color:#a94442'>{{ $errors->first('description') }}</strong>
  </span>
  @endif
  <div>
    <p><b>Decription</b></p>
    <textarea class="form-control" id="text" name="description">
		  @if($model->description)
		     {{ $model->description }}
	      @else
		  {{old('description')}}
	      @endif
		</textarea>
  </div>
</div>


<br><br>



@section('js_block')
@parent
<script>
  CKEDITOR.replace('text', {
    filebrowserUploadUrl: "{{ route('blog', ['_token' => csrf_token()]) }}",
    filebrowserUploadMethod: 'form',

  });
</script>

@endsection