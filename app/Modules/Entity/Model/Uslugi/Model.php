<?php
namespace Modules\Entity\Model\Uslugi;

use Modules\Entity\ModelParent;
use Modules\Entity\Traits\CheckTrans;
use App\Models\User;
use App\Models\File;
use Modules\Entity\Model\Slider2\Model as Slider2;
class Model extends ModelParent {
    protected $table = 'uslugi';
	protected $with = ['files','sliders'];
	protected $fillable = ['photo','name','usluga_id','description','seo_title','seo_desc','user_id','file_id'];
	
	
   //protected $filter_class = Filter::class; 
    use Presenter,CheckTrans;
    
	
	public function sliders()
    {
        return $this->hasMany(Slider2::class, 'usluga_id','id');
    }
	
	public function files()
    {
        return $this->belongsTo(File::class, 'file_id');
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
