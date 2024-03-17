<?php
namespace Modules\Entity\Traits;

use Modules\Entity\Services\ChangeModelService;
use Route;
use Cache;

//use Modules\Entity\Model\ContentManager\ContentManager;
//use Modules\Entity\Model\Moderator\Moderator;
use Illuminate\Support\Facades\Request;

use Auth;
use RoleService;
use App\Helper\CurrentLang;
trait ChangeModel {
    protected static function boot(){

        static::updating(function ($el) {
	
           //ChangeModelService::createUpdateNote($el);
            return true;
        });

        static::created(function ($el) {
		
            //ChangeModelService::createCreateNote($el);
            return true;
        });

        static::deleted(function ($el) {
           
            //if($el->relTrans()){$el->relTrans()->delete();}
			

			
			return true;
		
           //ChangeModelService::createDeleteNote($el);
        });
        
        return parent::boot();
    }
}

?>
