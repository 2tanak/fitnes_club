<?php 
namespace Modules\Entity\Model\Region;
use Modules\Entity\Model\Rajon\Model as Rajon;
use Cache;
use Modules\Entity\Model\Mkp\Model as Mkp;
use Lang;

trait Presenter {
	
   function getMkpArr(){
	  $result= Mkp::pluck('name', 'id')->toArray();
	  return $result;
    }
	
function getRajonArr(){
	  $result= Rajon::pluck('name', 'id')->toArray();
	  return $result;
    }
	
	
function the_excerpt($text){
	  $text = preg_replace("~<img(.*)>~siU","",$text);
		return substr($text,0,100);
    }
	
	function getPhotoUnserializeAttribute(){
		
		if(@unserialize($this->gallery)){
			return unserialize($this->gallery);
		}else{
			return false;
		}
	 
	}
}

