<?php
namespace Modules\Entity\Model\Region;

use Modules\Entity\ModelParent;
//use Modules\Entity\Traits\CheckTrans;
use App\Models\User;
use App\Models\File;
use App\Traits\Optionable;
use Modules\Entity\Model\Rajon\Model as Rajon;
use Modules\Entity\Model\Mkp\Model as Mkp;
use App\Observers\RegionObserver;
class Model extends ModelParent {
	use Optionable;
    protected $table = 'region';
	//protected $with = ['files'];
	protected $fillable = ['name','rajon_id','trassa','gorod'];
	protected $filter_class = Filter::class; 
	protected static function boot()
    {
        parent::boot();
		  Model::observe(RegionObserver::class);
    }
	public function files()
    {
        return $this->belongsTo(File::class, 'file_id');
    }
	public function mkpBind()
    {
        return $this->hasMany(Mkp::class, 'id','mkp_id');
    }
	public function rayonBind()
    {
        return $this->hasOne(Rajon::class, 'id','rajon_id');
    }
	
	public function optinsBind()
    {
        return $this->hasOne('App\Models\Option', 'optionable_id','id');
    }
	
    //protected $filter_class = Filter::class; 
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
