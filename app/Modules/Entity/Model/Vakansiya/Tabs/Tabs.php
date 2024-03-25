<?php
namespace Modules\Entity\Model\Tabs;

use Modules\Entity\ModelParent;
use Modules\Entity\Traits\CheckTrans;

class Tabs extends ModelParent {
    protected $table = 'tabs';
	protected $fillable = [ 'photo','name','description','user_id','about_page_id','date','color','publish','edited_user_id'];
    protected $filter_class = Filter::class; 
    use Presenter,CheckTrans;
    
    function relCity(){
        return $this->belongsTo('Modules\Entity\Model\LibCity\LibCity', 'city_id');
    }
	
	 function sights(){
        return $this->belongsToMany('Modules\Entity\Model\Sights\Sights','Modules\Entity\Model\Home\SightsLib','home_id','sight_id');
    }
	 function relEditedUser(){
        return $this->belongsTo('App\User', 'edited_user_id');
    } 
	
	 function relInforms(){
        return $this->HasOne('Modules\Entity\Model\Informs\Informs', 'gid_id');
    }
	

	
  function relTrans(){
        return $this->hasOne('Modules\Entity\Model\Tabs\TransTabs', 'el_id');
    }
	

	function getTransTableNameAttribute(){
        return $this->getTable();
    }
	
	  function getElIdAttribute(){
        return $this->id;
    }


  
    


  
}
