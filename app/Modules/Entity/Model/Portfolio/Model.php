<?php
namespace Modules\Entity\Model\Portfolio;

use Modules\Entity\ModelParent;
use Modules\Entity\Traits\CheckTrans;
use App\Models\User;
use App\Models\File;
use Modules\Entity\Model\Portfolio\Category\Model as Cat;
class Model extends ModelParent {
    protected $table = 'portfolio';
	protected $with = ['files'];
	protected $fillable = ['photo','name','description','seo_title','seo_desc','user_id','file_id','cat_id'];
	
	
	
    protected $filter_class = Filter::class; 
    use Presenter;
    
	/*
	 protected static function boot() {
        //parent::boot();
        //static::addGlobalScope(new ContentManagerScope);
    }
  */
  
  public function files()
    {
        return $this->belongsTo(File::class, 'file_id');
    }
	public function category()
    {
        return $this->belongsTo(Cat::class, 'cat_id','id');
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
