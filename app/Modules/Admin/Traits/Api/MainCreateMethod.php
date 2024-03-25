<?php

namespace Modules\Admin\Traits\Api;

use Illuminate\Http\Request;

use Modules\Admin\Http\Requests\MainRequest;
use Session;
use Illuminate\Support\Facades\Validator;
//use SweetAlert;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use App\Models\Option;
use App\Models\Period;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Notifications\InquiryRegistration;
use Mail;
use Storage;
use App\Imports\BannersImport;
use App\Imports\BannersimgImport;
use Modules\Entity\Model\Banners\Model as Banners;


trait MainCreateMethod
{
	
    public function saveCreate(Request $request)
	{
		$proxy = \Request::create('/api/user', 'get', ['aaa'=>'b']);
        $resp = json_decode(app()->handle($proxy)->getContent());
		$user_id = (int) $request->user_id;
		$auth_user_id = (int) $resp->id;
		if($auth_user_id === $user_id && $auth_user_id != 1 ){
			
		$action = new $this->action_create(new $this->def_model(),$request);
		
		try {
			$result= $action->run();
			
		 } catch (\Exception $e) {
           return $e->message;
			
		}
		return ['user_id'=>$resp->id,'model'=>$result];
			
		}else{
			return false;
		}
		
		
	}




}
