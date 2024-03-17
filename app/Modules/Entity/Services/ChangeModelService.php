<?php
namespace Modules\Entity\Services;

use Modules\Entity\Model\SysModelLog\SysModelLog;

class ChangeModelService {
    static function createUpdateNote($el){
        $user = \Auth::user();

        $ar_before_attr = $el->getDirty();
        $ar_new_attr = $el->getOriginal();


		if (isset($ar_before_attr['remember_token'])){
            unset($ar_before_attr['remember_token']);
        }
		if (isset($ar_before_attr['password'])){
            unset($ar_before_attr['password']);
        }
		if (isset($ar_before_attr['user_id'])){
            unset($ar_before_attr['user_id']);
        }
		if (isset($ar_before_attr['token'])){
            unset($ar_before_attr['token']);
        }

        $note = '';

        foreach ($ar_before_attr as $k=>$v){
            if (!isset($ar_new_attr[$k]))
                continue;

            $note .= '<p>Поле "'.$el->getLabel($k).'", значение до "'.$ar_new_attr[$k].', значение после "'.$v.'" </p>';
        }

        SysModelLog::create([
            'user_id' => ($user ? $user->id : 0),
            'table_name' => $el->getTable(),
            'el_id' => $el->id,
            'note' => $note,
            'json_el' => json_encode($el->getOriginal()),
            'type' => 'update'
        ]);

    }

    static function createCreateNote($el){
        $user = \Auth::user();

        $ar_new_attr = $el->getDirty();

        $ar_need_delete = ['remember_token', 'password', 'created_at', 'updated_at', 'user_id', 'token', 'id', 'el_id'];
        foreach ($ar_need_delete as $v) {
            if (isset($ar_new_attr[$v]))
                unset($ar_new_attr[$v]);
        }

        $note = '';
        foreach ($ar_new_attr as $k=>$v){
            $note .= '<p>Поле "'.$el->getLabel($k).'" указано "'.$v.'" </p>';
        }

        SysModelLog::create([
            'user_id' => ($user ? $user->id : 0),
            'table_name' => $el->getTable(),
            'el_id' => $el->id,
            'note' => $note,
            'json_el' => json_encode($el->getDirty()),
            'type' => 'created'
        ]);
    }

    static function createDeleteNote($el)
    {
        $user = \Auth::user();

        $note = '<p>Элемент таблицы "'.$el->getTable().'" удалено"</p>';

        SysModelLog::create([
            'user_id' => ($user ? $user->id : 0),
            'table_name' => $el->getTable(),
            'el_id' => $el->id,
            'note' => $note,
            'json_el' => json_encode($el->getDirty()),
            'type' => 'delete'
        ]);
    }

}

?>
