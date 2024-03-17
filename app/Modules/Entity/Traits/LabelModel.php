<?php
namespace Modules\Entity\Traits;

use App;

use Route;
use Lang;
trait LabelModel  {
    function getLabel($field){
        if ($field == 'id')
            return $field;

        if ($field == 'created_at' || $field == 'created_cool')
            return trans('model.created_at');

        if ($field == 'updated_at' || $field == 'updated_cool')
            return trans('model.updated_at');

        if ($field == 'edited_user_id')
            return trans('model.edited_user_id');
		
		  $action = Route::currentRouteAction();
		  $action_index = strpos($action,'index');
		  if($action_index){$this->lang = 'ru'; App::setLocale($this->lang);  }
		 
		  App::setLocale('ru');
		  return Lang::get('model.'.$this->getTable().'.'.$field);
    }

    function label($field){
        return $this->getLabel($field);
    }
    
}
