<?php
namespace Modules\Entity\Model\Statistics;

use Modules\Entity\ModelParent;

use Modules\Entity\Traits\CheckTrans;

use App\Models\User;

use App\Models\File;

use App\Observers\StatisticsObserver;

class Model extends ModelParent {
    protected $table = 'statistics';
	//protected $with = ['files'];
	protected $fillable = ['month','name','active','slug','uid'];
	

    protected $filter_class = Filter::class; 
    use Presenter;
    protected static function boot()
    {
        parent::boot();
		  //Model::observe(StatisticsObserver::class);
		  //static::addGlobalScope(new ContentManagerScope);
    }

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
