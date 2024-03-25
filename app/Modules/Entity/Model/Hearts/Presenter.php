<?php 
namespace Modules\Entity\Model\Hearts;

use Cache;

use Lang;

use Modules\Entity\Model\Portfolio\Category\Model as Category;

trait Presenter {
	
public function category()
 {
    return $this->belongsTo(Category::class,'cat_id','id');
 }
 
function getCatArr(){
	
	  $category= Category::pluck('name', 'id')->toArray();
	  return $category;
}

function the_excerpt($text){
	  $text = preg_replace("~<img(.*)>~siU","",$text);
		return substr($text,0,100);
    }
	
	
}

