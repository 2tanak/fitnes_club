<?php
namespace Modules\Entity\Model\Mkp;

use Modules\Entity\ModelParent;
use Modules\Entity\Traits\CheckTrans;
use App\Models\User;
use App\Models\File;
use App\Traits\Optionable;
class Model extends ModelParent {
	use Optionable;
    protected $table = 'mkp';
	//protected $with = ['files'];
	protected $fillable = ['name'];
	protected $filter_class = Filter::class; 
	
	public function files()
    {
        return $this->belongsTo(File::class, 'file_id');
    }
	
	
	public function optinsBind()
    {
        return $this->hasOne('App\Models\Option', 'optionable_id','id');
    }
	
    
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
