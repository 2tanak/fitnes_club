<?php
namespace Modules\Entity\Model\Orders;

use Modules\Entity\ModelParent;

use Modules\Entity\Traits\CheckTrans;

use App\Models\User;

use Modules\Entity\Model\Banners\Model as Banners;

use Modules\Entity\Model\Products\Model as Products;

class Model extends ModelParent {
    protected $table = 'orders';
	protected $with = ['products'];
	
	protected $fillable = ['user_id','order_id','total_summ'];
	
	/*
	public function getRouteKeyName() {
       return 'user_id'; 
    }
	*/

    //protected $filter_class = Filter::class; 
    use Presenter;
    
	function products()
    {
        return $this->hasMany(Products::class, 'order_id','id');
    }
	function banners()
    {
        return $this->belongsTo(Banners::class, 'banner_id','id');
    }
	
	
	
	
	
	/*
	 protected static function boot() {
        //parent::boot();
        //static::addGlobalScope(new ContentManagerScope);
    }
  */
	 function relEditedUser(){
        return $this->belongsTo('App\Models\User', 'edited_user_id');
    } 
	
 
	 function lang(){
        return $this->belongsToMany(
		'Modules\Entity\Model\LibLanguage\LibLanguage',
		'Modules\Entity\Model\Gid\GidLang', 'gid_id','lang_id');
    }
	



    function langs() {
        return $this->hasMany('Modules\Entity\Model\Gid\GidLang','gid_id','id');
    }
	
	
  function relTrans(){
        return $this->hasOne('Modules\Entity\Model\Gid\TransGid', 'el_id');
    }
	

	
	   function getTransTableNameAttribute(){
        return $this->getTable();
    }
	  function getElIdAttribute(){
        return $this->id;
    }

}
