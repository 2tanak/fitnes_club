<?php
namespace Modules\Entity\Model\Banners;

use Modules\Entity\ModelParent;
use Modules\Entity\Traits\CheckTrans;
use App\Models\User;
use App\Models\File;
use App\Observers\BannerObserver;
class Model extends ModelParent {
    protected $table = 'banners';
	public $timestamps = false;
	//protected $with = ['files'];
	protected $fillable = [
	'unikalnyi_nomer',
	'raion',
	'elpocta_podryadcika',
	'po','federalnyi_obekt','naselennyi_punkt','mkr','format','naimenovanie','storona','napravlenie_raion','foto','karta','gps','arenda','goryacee_predlozenie','montaz',
	'izgot','ocenka','kod_rk','kod_podstanovki','foto_s_praisa_podryada','ssylka_na_kartu',
	'svet','spec','spec_do','prais','skidka','1_montaz','dop_montaz','grp','ots','vremya_raboty_ekranov','razresenie','pecat','yanvar','fevral','mart','aprel','mai','iyun','iyul','avgust','sentyabr','oktyabr','noyabr','dekabr'
	];
	
	protected $filter_class = Filter::class; 
    use Presenter;
	protected static function boot()
    {
        parent::boot();
		  //Model::observe(BannerObserver::class);
    }
	function aa(){
		dd(11);
	}
	public function files()
    {
        return $this->belongsTo(File::class, 'foto');
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
