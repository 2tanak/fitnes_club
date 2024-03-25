<?php
namespace Modules\Entity\Traits;

use Illuminate\Http\Request;

trait RoleModel  {
    protected $role_list_class = false;

    public function scopeGetByRole($query, Request $request){
        if (! $this->role_list_class)
            return $query;

        $list_class = $this->role_list_class;
       
        $list = new $list_class($query, $request);
        $list->calc();
        
        return $list->getQuery();
    }

}
