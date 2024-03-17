<?php
namespace Modules\Entity\Model\Products;

use Modules\Entity\Services\ModelFilter;
use Auth;
use Illuminate\Support\Facades\Request;

class Filter extends ModelFilter {
    public function filter(){
		 $request  = $this->request;
		
         if ($this->request->has('user_id')){
			$this->query->where('user_id','=',$request->user_id);
         }
       
    }

}
