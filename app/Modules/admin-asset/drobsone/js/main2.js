$(function(){
$('.slider_remove').on('click',function(e){
	var path = $(this).attr('href');
	var id = $(this).attr('id');
	
	e.preventDefault();
	 var ctx = $(this);
		$.ajax({
		  url:'/slider-remove',
		  data:{path:path,id:id },
		  type:'POST',
		  datatype:'JSON',
		    beforeSend: function() {
			ctx.replaceWith('<span  class="replace" style="color:"#000">выполняется..</span>');
           
          },
		  success: function(html) {
			  $(this).remove();
			  var r = $('.replace');
	r.replaceWith('<span style="color:red">удалено</span>');

			  console.log(html);
		  },
		});
})


    var myDropzone = new Dropzone("div#file", {
        url: "/drobsone-send",
        maxFiles: 10,
        //maxFilesize: 2,
		  addRemoveLinks: true,
removedfile: function(file) {
	var name = file.name; 
		$.ajax({
		  url:'/drobsone-remove',
		  data:{name:name},
		  type:'POST',
		  datatype:'JSON',
		  success: function(html) {
			  console.log(html);
		  },
		});
	/*
	 $.ajax({
        type: 'POST',
        url: 'drobsone-remove',
        data: "id="+name,
        dataType: 'html'
    });
	*/
    var _ref;
    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
  },
        dictFileTooBig: "Максимальный размер файла - 1 Мб",
        dictMaxFilesExceeded: "Достигнут лимит загрузки файлов, разрешено {{maxFiles}}",
        init: function(){
            $(this.element).html(this.options.dictDefaultMessage);
        },
        dictDefaultMessage: '<div class="dz-message">Нажмите здесь или перетащите сюда файлы для загрузки</div>',
        acceptedFiles: '.jpg, .jpeg, .png, .gif',
        dictInvalidFileType: 'Разрешены к загрузке файлы: .jpg, .jpeg, .png, .gif',
        success: function(file, responce){
			console.log(responce);
            var url = file.dataURL,
                res = responce;
				 if(res.answer == 'error2'){
				//console.log('error');
                this.removeFile(file);
				 }
            if(res.answer == 'error'){
				//console.log('error');
                this.removeFile(file);
				
                $('.preview').html(`<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    ${res.error}
                </div>`);
            }else{
                this.defaultOptions.success(file);
            }
        }
    });

});