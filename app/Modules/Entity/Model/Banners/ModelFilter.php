<?php
namespace Modules\Entity\Model\Banners;

use Illuminate\Http\Request;

use Modules\Entity\Model\Konstrukciya\Model as Konstrukciya;
class ModelFilter{
    protected $query = false;
    protected $request = false;
    public $konstrukciya=null;
    public function __construct($query, Request $request){

        $this->query = $query;
        $this->request = $request;
		$this->konstrukciya= Konstrukciya::pluck('name', 'slug')->toArray();
    }

    function getQuery(){
        return $this->query;
    }
    
}
