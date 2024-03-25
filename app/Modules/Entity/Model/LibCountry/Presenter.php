<?php 
namespace Modules\Entity\Model\LibCountry;
use Modules\Entity\Model\LibContinent\LibContinent;
use Cache;
trait Presenter {
    function getContinentAr(){
		if(Cache::has('continent')){
		$cache = Cache::get('continent');
        return $cache;
		}else{
		Cache::forever('continent',LibContinent::pluck('name', 'id')->toArray());
		return LibContinent::pluck('name', 'id')->toArray();
		}
	}

    function getEditedUserNameAttribute(){
        return ($this->relEditedUser ?  $this->relEditedUser->name : '');
    }

    function getContinentNameAttribute(){
        return ($this->relContinent ?  $this->relContinent->name : '');
    }

    function getNameAttribute($v){
        return $this->getTransField('name', $v);
    }

}

