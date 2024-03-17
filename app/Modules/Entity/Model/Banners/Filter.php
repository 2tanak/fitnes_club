<?php
namespace Modules\Entity\Model\Banners;

//use Modules\Entity\Services\ModelFilter;

use Auth;

use Illuminate\Support\Facades\Request;

//use Modules\Entity\Model\Konstrukciya\Model as Konstrukciya;

class Filter extends ModelFilter {
	
	 
	
    public function filter(){
		$request  = $this->request;
         if ($this->request->has('min_price_arenda') && $this->request->has('max_price_arenda')){
			 $max= (int) $this->request->max_price_arenda;
			 $min= (int) $this->request->min_price_arenda;
             $this->query->orWhereBetween('arenda', [$min, $max]);
         }
		 if ($this->request->has('naselennyi_punkt')){
            $this->query->where('raion',$this->request->naselennyi_punkt)->orWhere('naselennyi_punkt',$this->request->naselennyi_punkt)->orWhere('federalnyi_obekt',$this->request->naselennyi_punkt)->orWhere('mkr',$this->request->naselennyi_punkt);
			
         } 
		 
		  if ($this->request->has('svet')){
			$this->query->where('svet', 'да');
		  }
		  if($this->request->has('storona')){
			  if($this->request->storona){
			    $this->query->where('storona', mb_strtolower($this->request->storona));
			  }
		  }
		  if($this->request->has('statica')){
			  $this->query->where('format', 'like', '%'.'статичн'.'%');
			  /*
				$this->konstrukciya['statica'] = 'статичн';
				$this->request->request->add(['konstrukciya' => [...$this->request->konstrukciya ? :[],'statica']]);
				*/
		  }
		  if($this->request->has('number')){
			  $this->query->where('format', 'like', '%'.'цифро'.'%');
			   /*
				$this->konstrukciya['number'] = 'цифро';
				$this->request->request->add(['konstrukciya' => [...$this->request->konstrukciya ? :[],'number']]);
				*/
			 }
	
          if ($this->request->has('format')){
			  $format = $request->format;
			  if(!is_array($request->format)) {
				$format = explode(',', $request->format);
			} 
			 $konstrukciya= $this->konstrukciya;
			 
             $this->query->where(function($q) use($format,$konstrukciya){
				
			 foreach($format as $v){
				 if($v && $v !=''){
					 $name = $konstrukciya[$v];
					  $q->orWhere('format', 'like', '%'.$name.'%');
			   }
			 }
          });
		}
         if ($this->request->has('month')){
	        $r= $this->request;
            $this->query->where(function ($q) use($r){
              foreach($r->month as $period){
				 if($period && $period !=''){
				 $q->orWhere($period, '=', '1');
				 }
			 }
           });
		   
        }
        
        
	
        
    
      }
    }


