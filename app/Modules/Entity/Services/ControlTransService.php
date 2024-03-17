<?php
namespace Modules\Entity\Services;

use Modules\Entity\Model\StatTrans\StatTrans;
use Modules\Entity\Model\SysLang\SysLang;

class ControlTransService {
    static function check($el, $lang){
		
        if ($lang == 'ru')
            return true;
            
        $stat = StatTrans::where('table_name', $el->trans_table_name)->where( 'el_id', $el->el_id)->where('lang', $lang)->first();
        if (!$stat)
            return false;

        return $stat->is_fill;
    }

    static function calc($el){
        if (!$el->trans_table_name || !$el->el_id)
            return false;
            
        $table_name = $el->getTable();
        if (strpos($table_name, 'trans_') !== false){
            $model = StatTrans::firstOrCreate(['table_name'=>$el->trans_table_name, 'el_id'=>$el->el_id, 'lang'=>$el->lang]);

            $ar_trans_fileds = $el->trans_fileds;
            
            $is_fill = 1;
            $is_half_fill = 0;
            foreach ($el->trans_fileds as $attr){
                if ($el->{$attr})
                    $is_half_fill = 1;
                
                if (!$el->{$attr})
                    $is_fill = 0;
            }

            if ($model->is_fill != $is_fill || $model->is_half_fill != $is_half_fill)
                $model->update(['is_half_fill' => $is_half_fill, 'is_fill' => $is_fill]);
        }
        else if (strpos($table_name, 'lib_') !== false) {
            $ar_lang =  SysLang::pluck('sys_key')->toArray();
            foreach ($ar_lang as $lang){
                if ($lang == 'ru')
                    continue;

                $e = $el->relTrans()->firstOrCreate(['lang'=>$lang, 'table_name' => $table_name]);
            }
        }
        else {
            $ar_lang =  SysLang::pluck('sys_key')->toArray();
            foreach ($ar_lang as $lang){
                if ($lang == 'ru')
                    continue;

                $e = $el->relTrans()->firstOrCreate(['lang'=>$lang]);
            }
        }

       
    }

}

?>
