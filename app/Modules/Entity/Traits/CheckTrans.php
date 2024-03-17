<?php
namespace Modules\Entity\Traits;

use Modules\Entity\Services\ControlTransService;

trait CheckTrans {
    protected static function boot(){
        static::created(function ($el) {
			
            //ControlTransService::calc($el);
            return true;
        });
        static::updated(function ($el) {
            //ControlTransService::calc($el);
            return true;
        });
        
        return parent::boot();
    }
}

?>
