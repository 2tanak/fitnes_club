<?php 
namespace Modules\Entity\Model\Rajon;

use Cache;

use Lang;

trait Presenter {
	
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

