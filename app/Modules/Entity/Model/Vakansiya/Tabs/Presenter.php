<?php 
namespace Modules\Entity\Model\Tabs;

use Modules\Entity\Model\LibCity\LibCity;
use Modules\Entity\Model\Sights\Sights;


//use Modules\Entity\Model\LibRequirement\LibRequirement;

use Cache;

trait Presenter {
	function getSightsAr(){
		return Sights::pluck('name', 'id')->toArray();
    }
	
	
	function getPhotoUnserializeAttribute(){
		if(@unserialize($this->photo)){
			return unserialize($this->photo);
		}else{
			return $this->photo;
		}
	 
	}
	function getArSightsAttribute(){
	   return $this->sights()->pluck('sight_id')->toArray();
     }
	 function getPublishIndexAttribute($v){
	 return array_search($this->publish,['черновик'=>1,'активно'=>2]);
    }
	
	
	function getAddress2Attribute($v){
	   
	     $ar= explode(',',$this->coord);
		if(count($ar) < 2){
			$ar[0] = 59.9342802;
			$ar[1] = 30.335098600000038;
		}
		 return $ar;
		  }
	function getCityAr(){
		return LibCity::pluck('name', 'id')->toArray();

    }
	

function getNameAttribute($v){
		return $this->getTransField('name', $v);
	  }

	
	function getDescriptionAttribute($v){
		return $this->getTransField('description', $v);
	  }
	
function getSeoTitleAttribute($v){
		return $this->getTransField('seo_title', $v);
    }
	
	function getSeoDescriptionAttribute($v){
		return $this->getTransField('seo_description', $v);
    }
	
}

