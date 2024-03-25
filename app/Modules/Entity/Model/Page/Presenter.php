<?php 
namespace Modules\Entity\Model\Page;

use Cache;

use Lang;

trait Presenter {
	
function the_excerpt($text){
	  $text = preg_replace("~<img(.*)>~siU","",$text);
		return substr($text,0,100);
    }
	
	
}

