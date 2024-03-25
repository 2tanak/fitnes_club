<?php
namespace Modules\Entity\Model\Hearts;

use Modules\Entity\ModelParent;

use Modules\Entity\Traits\CheckTrans;

use App\Models\User;

use Modules\Entity\Model\Banners\Model as Banners;

class Model extends ModelParent {
    protected $table = 'hearts';
	protected $with = ['banners'];
	
	protected $fillable = ['user_id','banner_id'];
	
	/*
	public function getRouteKeyName() {
       return 'user_id'; 
    }
	*/
function banners()
    {
        return $this->belongsTo(Banners::class, 'banner_id','id');
    }
	
    protected $filter_class = Filter::class; 
    use Presenter;
    
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
