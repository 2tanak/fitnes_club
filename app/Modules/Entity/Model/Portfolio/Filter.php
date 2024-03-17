<?php
namespace Modules\Entity\Model\Portfolio;

use Modules\Entity\Services\ModelFilter;
use Auth;
use Illuminate\Support\Facades\Request;

class Filter extends ModelFilter {
    public function filter(){
		 $request  = $this->request;
         if($this->request->has('cat_id')){
			 
			   $this->query->where('cat_id',$request->cat_id);
		 }

        
    
      }
    }


