<?php
namespace Modules\Entity\Services;
use Auth;
use Modules\Entity\Model\SysTooltip\SysTooltip;

class TooltipGenerator {
    static function get($module, $prop){
		
        $el = SysTooltip::firstOrCreate(['module' => $module, 'prop' => $prop]);
        if (!$el->note)
            return false;

        return $el->note;
    }

}

?>
