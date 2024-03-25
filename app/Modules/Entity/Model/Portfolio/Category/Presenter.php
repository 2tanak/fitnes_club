<?php 
namespace Modules\Entity\Model\Portfolio\Category;

use Cache;

use Lang;



trait Presenter {
	
	

	
function the_excerpt($text){
	  $text = preg_replace("~<img(.*)>~siU","",$text);
		return substr($text,0,100);
    }
	
	
}

