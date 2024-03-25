<?php 
namespace Modules\Entity\Model\Locality;

use Cache;

use Lang;

trait Presenter {
	function getRajonArr(){
	
	  $uslugi= Rajon::pluck('name', 'id')->toArray();
	  return $uslugi;
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

