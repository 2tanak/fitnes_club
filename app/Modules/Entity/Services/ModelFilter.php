<?php
namespace Modules\Entity\Services;

use Illuminate\Http\Request;

class ModelFilter{
    protected $query = false;
    protected $request = false;

    public function __construct($query, Request $request){

        $this->query = $query;
        $this->request = $request;
    }

    function getQuery(){
        return $this->query;
    }
    
}
