<?php
namespace Modules\Entity\Model\Tabs;

use Modules\Entity\ModelParent;
use Modules\Entity\Traits\CheckTrans;

class TransTabs extends ModelParent {
    protected $table = 'trans_tabs';
	 protected $table_ru = 'tabs';
    protected $fillable = [ 'el_id', 'lang', 'description','name'];
    //use CheckTrans;

    function getTransTableNameAttribute(){
        return 'tabs';
    }

    function getTransFiledsAttribute(){
       return  ['signature'];
    }
    
}
