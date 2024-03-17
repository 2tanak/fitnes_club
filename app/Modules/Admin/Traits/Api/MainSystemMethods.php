<?php
namespace Modules\Admin\Traits\Api;

use Illuminate\Http\Request;
use View;
use Route;
trait MainSystemMethods  {
    public function __construct(Request $request) {
		
		//$this->middleware('auth.admin');
		$route = Route::currentRouteName();
		
        $ar= explode('_',$route);
	
		$script = false;
		
		
		//View::share ('lang', $request->lang);
	    View::share ('model', new $this->def_model());
		if(isset($ar[1])){
		View::share ('rout', $ar[1]);
		}
		View::share ('view', $this->view_path);
        View::share ('route_path', $this->route_path);
        View::share ('request', $request);
    }
}