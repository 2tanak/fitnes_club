<?php
namespace Modules\Entity\Traits;

use Illuminate\Http\Request;

trait SortModel  {
    public function scopeOrder($query, Request $request){
        if (!$request->orderBy || $request->orderBy =='')
            return $query->latest();

        $order_by = $request->orderBy;
        $order_to = $request->orderTo;

        $ar_attr = $this->fillable;
        $ar_attr[] = 'id';
        $ar_attr[] = 'created_at';
        $ar_attr[] = 'updated_at';
        if (!in_array($order_by, $ar_attr))
            return $query->latest();

        if ($order_to == 'desc')
            return $query->orderBy($order_by, 'asc');

            
        return $query->orderBy($order_by, 'desc');
    }

}
