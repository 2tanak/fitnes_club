<?php

namespace Modules\Auth\Http\Controllers\User;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Entity\Actions\RegistrationAction;

use App\Models\User;
use Session;
use Illuminate\Support\Facades\Validator;
use Lang;
use Carbon\Carbon;

use Mail;
class RegistrationController extends Controller {
	
function index (Request $request){
		$ar = array();
        //$ar['title'] = trans('front_main.title.registration');
        $content = view('auth::auth.myuser.register')->with(['ar'=>$ar])->render();
		
        return view('auth::auth.myuser.index')->with(['content'=>$content])->render();
	}

  function register_nuxt(Request $request){
	  
	$validator = $this->validator($request->all());
	
    if ($validator->fails()) { 
	
	    return response()->json([
            'error' => $validator->errors()
        ]);
       
    };
	$role = 'buyer';
	//$user->roles()->sync(array(1, 2, 3));
	$action = new RegistrationAction(new User(), $request);
	
	try {
          $action->run();
        } catch (\Exception $e) {
			 return response()->json([
            'error' => 'error'
        ], 403);
        }
		return response()->json('ok', 204 );
		
    }
  function save(Request $request){
	
	$validator = $this->validator($request->all());
    if ($validator->fails()) { 
       return redirect()->back()->withErrors($validator)->withInput();
    };
	
	$action = new RegistrationAction(new User(), $request);
	
	try {
          $action->run();
        } catch (\Exception $e) {
			
            return redirect()->route('registration')->with('error', $e->getMessage());
        }
		return redirect()->route('vhod')->with('success', trans('front_main.message.success_registration'));
    }
	
	
   
protected function validator(array $data)
    {
	$messages = [
	'email.email' => 'Не правильный формат email',
     'email.required' => 'Email обязательное поле',
     'email.unique' => 'Такой email уже есть',
     'email.string' => 'Email строковый тип данных',
	 'email.password' => 'Email строковый тип данных',
   ];
			
		
    //(?=.*[0-9]) - строка содержит хотя бы одно число;
    //(?=.*[!@#$%^&*]) - строка содержит хотя бы один спецсимвол;
    //(?=.*[a-z]) - строка содержит хотя бы одну латинскую букву в нижнем регистре;
    //(?=.*[A-Z]) - строка содержит хотя бы одну латинскую букву в верхнем регистре;
    //[0-9a-zA-Z!@#$%^&*]{6,} - строка состоит не менее, чем из 6 вышеупомянутых символов.

        return Validator::make($data, [
		    'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min8|confirmed',
			//'password' => //'required|string|min:6|confirmed|regex:/(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])/u',
			'password' => 'required|min:8',

        ],$messages);
    }


}
