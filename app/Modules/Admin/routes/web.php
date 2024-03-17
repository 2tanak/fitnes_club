<?php
//'verified'
Route::group(['middleware' => ['auth:sanctum']], function () {
Route::prefix('admin')->group(function() {
	
    Route::get('/', 'AdminController@index')->name('admin_index');
	
	  Route::group(['prefix' => 'blog', 'namespace' => 'Blog'], function () {
		   Route::get('/', 'StartController@index')
             ->name('admin_blog');
			 
		  Route::get('create', 'StartController@create')
		        //->middleware('can:create,Modules\Entity\Model\Category\Model')
                ->name('admin_blog_create');
				
				Route::post('create', 'StartController@saveCreate')
               ->name('admin_blog_create_save');
			   
			     Route::get('update/{news}/{lang?}', 'StartController@update')
			   //->middleware('can:update,gallery')
               ->name('admin_blog_update');
			   
			    Route::post('update/{news}', 'StartController@saveUpdate')
               ->name('admin_blog_update_save');
			   
			    Route::get('delete/{news}', 'StartController@delete')
               ->name('admin_blog_delete');
		  
	  });
	
	
});
});

Route::group(['namespace' => 'Edit'], function () {
Route::any('blog',['uses' => 'CkeditorController@blog'])->name('blog');

Route::any('drobsone-send-blog',['uses' => 'CkeditorController@blog'])->name('drobsone-send-blog');

Route::any('blog/remove',['uses' => 'CkeditorController@remove'])->name('remove');

});