$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$(document).ready(function () {
    $('.file-input').fileinput({
        uploadUrl: "http://localhost",
        uploadAsync: true,
        browseLabel: 'Загрузить',
        browseIcon: '<i class="icon-file-plus"></i>',
        removeIcon: '<i class="icon-cross3"></i>',
        layoutTemplates: {
            icon: '<i class="icon-file-check"></i>'
        },
        initialCaption: "Не выбрано файлов",
        allowedFileExtensions: ["png", "jpeg", "jpg", "gif"],
        showUpload: false,
        removeCaption: "Удалить",
    });


    $('.table-togglable').footable();

    $('.select2').select2({
        minimumResultsForSearch: Infinity
    });




    $(".need_validate_form").submit(function (e) {
		
		var token = $('meta[name="csrf-token"]').attr('content');
		
	
		var data = $(this).serializeArray();

	data.push({name:'ajax',value:'ajax'});
	var rank_unikum = $(this).find('input[name="rank_unikum"]');
	
	if(rank_unikum){
		
	var data_rank_unikum = rank_unikum.attr('id');
	var value = rank_unikum.val();

	if(data_rank_unikum  == 'rank_unikum' && value){
	$('#rank_unikum').attr('data-message2','')
	
	   $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
				headers:{'X-CSRF-TOKEN': token},
				data:data,
				datatype:'JSON',
                async: false,
            }).then(function (data) {
				data = JSON.parse(data);
				//console.log(data);return false;
				if(data.content){
				var data = data.content;
				var message = data.rank_unikum[0]; e.preventDefault();
				$('#rank_unikum').attr('data-message2',message);
				return false;
						
			}
			return false;
			 });
		
		
	}
		
		
	}
		
		
		
		
		
		
		
        let res = true;
        $(this).find('.form-control').each(function (index, value) {
            let v = needValidateAttr(this, true);
            if (!v)
                res = false;
        });





if (!res) {
            $('html, body').animate({ scrollTop: ($(".has-error:first").offset().top - 15) }, 'slow');
            new PNotify({
                title: 'Внимание',
                text: 'Имеются пустые или некорректно заполнены поля.',
                icon: 'icon-blocked',
                type: 'error'
            });

            e.preventDefault();
        }

    });

    $('.need_validate_form').on('change', '.form-control', function () {
        needValidateAttr(this);
    });
var valid2 = false;
    function needValidateAttr(el, submit = false) {
		/*
        if ($(el).val() && $(el).attr('type') != 'file' && $(el).attr('type') != 'email')
            $(el).val($(el).val().trim());
*/
        let parent = $(el).parent();

        parent.children('.help-block').remove();
        parent.removeClass('has-error');
        parent.removeClass('has-error');

        let valid = el.checkValidity();
        let message = el.validationMessage;
		

        if (valid && $(el).attr('type') == 'file' && $(el).data('file_max') && $(el).val()) {
            let file_size = el.files[0].size;

            if (file_size > ($(el).data('file_max') * 1000000)) {
                message = "Ваш файл превышает максимальный разрешенный размер";
                valid = false;
                $(el).val('');
            }
        }

        if (valid && $(el).data('len')) {
            if ($(el).val().length > parseInt($(el).data('len'))) {
                message = "Указанное значение больше " + parseInt($(el).data('len')) + " символам. Вы указали " + $(el).val().length + " символов";
                valid = false;
            }
            else if ($(el).val().length < parseInt($(el).data('len'))) {
                message = "Указанное значение меньше " + parseInt($(el).data('len')) + " символам. Вы указали " + $(el).val().length + " символов";
                valid = false;
            }
        }

        if (!submit && valid && $(el).data('exist_url')) {
            let url = $(el).data('exist_url');
            url = url + $(el).val();
            $.ajax({
                type: 'GET',
                url: url,
                async: false,
            }).then(function (data) {
                if (!data.val) {
                    message = data.message;
                    valid = false;
                }
            });
        }

        if (valid && submit == true && parent.hasClass('has-error')) {


            return false;
        }
valid2 = el.getAttribute('data-message2');
if(valid2){
message = valid2;
valid2 = false;
valid = false;

		}
		
        if (valid) {
            parent.addClass('has-success');

            return true;
        }
        else {


            parent.addClass('has-error');
            parent.append('<span class="help-block">' + message + '</span>');

            return false;
        }
    }
});