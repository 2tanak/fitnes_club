<?php
namespace Modules\Entity\Model\LibCity;

use Modules\Entity\Services\ModelFilter;

class Filter extends ModelFilter {
    public function filter(){
        if ($this->request->has('id') && $this->request->id) 
            $this->query->where('id', $this->request->id);

        if ($this->request->has('name') && $this->request->name) 
            $this->query->where('name', 'like', '%'.$this->request->name.'%');
        
    }

}
