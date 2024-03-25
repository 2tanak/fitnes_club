<?php
namespace Modules\Entity\Services;

use Modules\Entity\Model\SysDisklaimer\SysDisklaimer;

class DisklaimerGenerator {
    static function get($module, $part){
        $el = SysDisklaimer::firstOrCreate(['module' => $module, 'part' => $part]);
        if (!$el->note)
            return false;

        return $el->note;
    }

}

?>
