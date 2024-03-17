<?php
namespace Modules\Entity\Model\Gallery;

use Modules\Entity\ModelParent;
use Modules\Entity\Traits\CheckTrans;

class Requirement extends ModelParent{
    protected $table = 'requirements';
    protected $fillable = [ 'text'];
    protected $filter_class = Filter::class; 
   
    
    
/*
 function relTrans(){
        return $this->hasOne('Modules\Entity\Model\Gallery\TransGallery', 'el_id');
    }
*/
   

  
    


  
}
