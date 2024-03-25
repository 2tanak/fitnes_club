<?php


namespace App\Services\Route;

class Routerclass

{
	public $current_route;
    public function current_route() {
	  $route = \Route::currentRouteName();
      $this->current_route=$route;
	  return $this->current_route;
	}
	public function get_current_page($number) {
		
		$this->current_route();
		$route= $this->current_route;
		$route= explode('_',$route);
		return $route[$number];
		
		//$this->current_route();
		
	}
	public function check_current_page($page=false) {
	 $this->current_route();
	 $route= $this->current_route;
	 $ar=explode('_',$route);
	
	 if(in_array($page,$ar)){
		 return true;
	 }else{
		 return false;
	 }
	 
	}
	public function segment($segment){
		
		//dd(url()->current());
		if($segment === 'last'){
		$segment = count(request()->segments());
		}
		
		return request()->segment($segment);
	}
	
}