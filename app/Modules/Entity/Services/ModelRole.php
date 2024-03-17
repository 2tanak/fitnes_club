<?php
namespace Modules\Entity\Services;

use Illuminate\Http\Request;

class ModelRole{
    protected $query = false;
    protected $request = false;
    protected $user = false;

    public function __construct($query, Request $request){
        $this->query = $query;
        $this->request = $request;
        $this->user = $request->user();
    }

    public function calc(){
        
    }

    public function getQuery(){
        return $this->query;
    }
}
