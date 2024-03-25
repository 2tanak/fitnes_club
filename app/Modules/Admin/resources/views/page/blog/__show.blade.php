<div class="row">
    <div class="col-md-4">
        <input-show name="city_id" id="city_id" :value="$model->city_name" :model='$model' :dataar="$model->getCityAr()" required />
    </div>
    <div class="col-md-4">
        <input-show name="name" id="name" :model='$model' required  />
    </div>
    <div class="col-md-4">
        <input-show name="origin_name" id="name" :model='$model' required  />
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <input-show-file name="logotip" id="logotip" :model='$model'   />
    </div>
    <div class="col-md-3">
        <input-show name="rank_word" id="rank_word" :model='$model'   />
    </div>
    <div class="col-md-3">
        <input-show name="rank_local" id="rank_local" :model='$model'   />
    </div>
	 <div class="col-md-3">
       <input-int name="rank_unikum" id="rank_unikum" :model='$model'/>
    </div>
  
    <div class="col-md-3">
        <input-show name="application_start" id="application_start" :model='$model'   />
    </div>
    <div class="col-md-3">
        <input-show name="application_end" id="application_end" :model='$model'   />
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <input-multi-select name="cat_id[]" id="cat_id" :model='$model' :value='$model->ar_cat_id' :dataar="$model->getCatAr()" disabled  />
    </div>
    <div class="col-md-12">
        <input-multi-select name="discipline_id[]" id="discipline_id" :model='$model' :value='$model->ar_discipline_id' :dataar="$model->getDisciplineAr()" disabled  />
    </div>
    <div class="col-md-12">
        <input-multi-select name="lang_id[]" id="lang_id" :model='$model' :value='$model->ar_lang_id' :dataar="$model->getLangAr()" disabled  />
    </div>
</div>

<fieldset class="content-group">
    <legend class="text-bold">@lang('model.university.detail_data')</legend>
    <div class="row">
        <div class="col-md-4">
            <input-show name="web_sait" id="web_sait" :model='$model->getRelDataObj()' group='data'   />
        </div>
        <div class="col-md-4">
            <input-show name="address_off" id="address_off" :model='$model->getRelDataObj()' group='data'   />
        </div>
        <div class="col-md-4">
            <input-show name="address_legal" id="address_legal" :model='$model->getRelDataObj()' group='data'   />
        </div>
        <div class="col-md-6">
            <input-show name="phones" id="phones" :model='$model->getRelDataObj()' group='data'   />
        </div>
        <div class="col-md-6">
            <input-show name="email" id="email" :model='$model->getRelDataObj()' group='data'   />
        </div>
        <div class="col-md-12">
            <input-show name="about_text" id="add_info" :model='$model->getRelDataObj()' group='data'   />
            <input-show name="student_life_text" id="achievement" :model='$model->getRelDataObj()' group='data'   />
        </div>
        <div class="col-md-4">
            <input-bool name="is_campus" id="is_campus" :model='$model->getRelDataObj()' group='data' disabled  />
        </div>
        <div class="col-md-4">
            <input-bool name="is_library" id="is_library" :model='$model->getRelDataObj()' group='data' disabled   />
        </div>
        <div class="col-md-4">
            <input-bool name="is_career" id="is_career" :model='$model->getRelDataObj()' group='data'  disabled  />
        </div>
        <div class="col-md-4">
            <input-bool name="is_clubs" id="is_clubs" :model='$model->getRelDataObj()' group='data'  disabled  />
        </div>
        <div class="col-md-4">
            <input-bool name="is_med_insurance" id="is_med_insurance" :model='$model->getRelDataObj()' group='data'  disabled  />
        </div>
        <div class="col-md-4">
            <input-bool name="is_inter_programm" id="is_inter_programm" :model='$model->getRelDataObj()' group='data'   disabled />
        </div>
    </div>
</fieldset>


<fieldset class="content-group">
    <legend class="text-bold">@lang('model.university.dormitory')</legend>
                                
    <label class="checkbox-inline ">
        <input type="checkbox" name="has_dormitory" id="has_dormitory" disabled value="1" {{ $model->getRelDormitory()->note ? 'checked' : '' }}> {{ $model->getLabel('has_dormitory') }} 
    </label>
    <div class="row js_dormitory_block">
        <div class="col-md-6">
            <input-show name="cost_min"  :model='$model->getRelDormitory()' group='dormitory'  />
        </div>
        <div class="col-md-6">
            <input-show name="cost_max" :model='$model->getRelDormitory()' group='dormitory'  />
        </div>
    </div>
    <div class="row js_dormitory_block">
        <div class="col-md-12">
            <input-show name="note" :model='$model->getRelDormitory()'  group='dormitory' />
        </div>
    </div>
</fieldset>

<fieldset class="content-group">
    <legend class="text-bold">@lang('model.university.stat_block')</legend>
    <div class="row">
        <div class="col-md-4">
            <input-show name="num_student_total" id="num_student_total" :model='$model->relStat' group='stat'   />
        </div>
        <div class="col-md-4">
            <input-show name="num_student_citizen" id="num_student_citizen" :model='$model->relStat' group='stat'   />
        </div>
        <div class="col-md-4">
            <input-show name="num_student_inter" id="num_student_inter" :model='$model->relStat' group='stat'   />
        </div>
        <div class="col-md-4">
            <input-show name="num_teacher_total" id="num_teacher_total" :model='$model->relStat' group='stat'   />
        </div>
        <div class="col-md-4">
            <input-show name="num_teacher_citizen" id="num_teacher_citizen" :model='$model->relStat' group='stat'   />
        </div>
        <div class="col-md-4">
            <input-show name="num_teacher_inter" id="num_teacher_inter" :model='$model->relStat' group='stat'   />
        </div>
    </div>
</fieldset>

<fieldset class="content-group">
    <legend class="text-bold">@lang('model.university.fees_block')</legend>
    @foreach ($model->getDegreeAr() as $id=>$name)
        @if ($loop->first)
            <div class="row">
        @endif
            <div class="col-md-4">
                {{ $name }}
            </div>
            <div class="col-md-2">
                <input-show name="for_citizen_min" id="for_citizen_min" :model='$model->getRelFeeObj($id)' :group='"fee[".$id."]"'   />
            </div>
            <div class="col-md-2">
                <input-show name="for_citizen_max" id="for_citizen_max" :model='$model->getRelFeeObj($id)' :group='"fee[".$id."]"'   />
            </div>
            <div class="col-md-2">
                <input-show name="for_inter_min" id="for_inter_min" :model='$model->getRelFeeObj($id)' :group='"fee[".$id."]"'   />
            </div>
            <div class="col-md-2">
                <input-show name="for_inter_max" id="for_inter_max" :model='$model->getRelFeeObj($id)' :group='"fee[".$id."]"'   />
            </div>
        
        @if ($loop->first)
            </div>
        @endif
    @endforeach
</fieldset>


<fieldset class="content-group">
    <legend class="text-bold">@lang('model.university.coor_block')</legend>
    <div class="row">
        <div class="col-md-12">
            <div id='map' style="width: 100%; height: 300px;" ></div>
        </div>
        <input type="hidden" name="data[coor]" value="{{ $model->getRelDataObj()->coor }}" id="data_coor">
    </div>  
</fieldset>



@section('js_block')
	@parent
    <script type="text/javascript" src="//api-maps.yandex.ru/2.1/?lang=ru-RU" ></script>
	
    <script >
        $(document).ready(function () {
            function showDormitory(){
                console.log($('#has_dormitory').is(':checked'), $('.js_dormitory_block').addClass('asdasd'));
                if ($("#has_dormitory").is(':checked'))
                    $('.js_dormitory_block').show();
                else 
                    $('.js_dormitory_block').hide();
            }

                    $('.js_dormitory_block').hide();
            showDormitory();
            $('#has_dormitory').change(function(){
                showDormitory();
            });


            function calcTotalStudent(){
                let st_1 = parseInt($('#num_student_citizen').val());
                let st_2 = parseInt($('#num_student_inter').val());
                
                if (isNaN(st_1))
                    st_1 = 0;
                if (isNaN(st_2))
                    st_2 = 0;

                $('#num_student_total').val(st_1 + st_2);
            }

            $('#num_student_citizen').change(function(){
                calcTotalStudent();
            });
            $('#num_student_inter').change(function(){
                calcTotalStudent();
            });

            
            function calcTotalTeacher(){
                let st_1 = parseInt($('#num_teacher_citizen').val());
                let st_2 = parseInt($('#num_teacher_inter').val());
                
                if (isNaN(st_1))
                    st_1 = 0;
                if (isNaN(st_2))
                    st_2 = 0;

                $('#num_teacher_total').val(st_1 + st_2);
            }

            $('#num_teacher_citizen').change(function(){
                calcTotalTeacher();
            });
            $('#num_teacher_inter').change(function(){
                calcTotalTeacher();
            });




            var myMap;
            ymaps.ready(init);
            var ar_coor = [];

            function init()
            {

                try {
                    ar_coor = JSON.parse($('#data_coor').val());
                } catch (err) {
                    ar_coor = [];
                }

                
                console.log(ar_coor);

                myMap = new ymaps.Map("map",{
                    center: [51.14345176, 71.44592914],
                    zoom: 3,
                    behaviors: ["default", "scrollZoom"]
                },
                {
                    balloonMaxWidth: 300
                });

                
                $.each( ar_coor, function( key, value ) {
                    myPlacemark = new ymaps.Placemark(value);
                    myPlacemark.unix_id = ar_coor.length - 1;
                    myMap.geoObjects.add(myPlacemark);

                    myPlacemark.events.add('click', function (e) {
                        var pl = e.get('target');

                        ar_coor.splice(pl.unix_id, 1);
                        myMap.geoObjects.remove(pl);

                        
                        $('#data_coor').val(JSON.stringify(ar_coor));
                    });
                    
                });


               
            }
        });
    </script>
@endsection
