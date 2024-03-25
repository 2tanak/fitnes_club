<?php
namespace Modules\Entity\Model\Mkp;

use Modules\Entity\Services\ModelFilter;
use Auth;
use Illuminate\Support\Facades\Request;

class Filter extends ModelFilter {
    public function filter(){
		
    return $this->query->orderBy('name');

    }

}
