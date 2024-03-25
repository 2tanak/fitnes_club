<?php

namespace Modules\Auth\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Hash;
use Auth;
use Modules\Entity\Model\SysUserType\SysUserType;
use Session;

class LoginController extends Controller
{
    function index(Request $request)
    {
        dd(100);
        return view('auth::index')->render();
    }

    function check(Request $request)
    {
       
        $user = User::where('email', $request->email)->first();
       
       
	     
        if (!$user) {
            return back()->with('error', trans('front_main.message.wrong_access'));
        }
        if (!Hash::check($request->password, $user->password)) {

            return back()->with('error', trans('front_main.message.wrong_access'));
        }
		 if($user->hasRole('buyer')){
			return redirect()->route('vhod')->with('error', trans('front_main.message.access_denied'));
		 }
		
        $user_auth = auth()->user();
		
	    if(isset($user_auth)){
	       $request->session()->invalidate();
           $request->session()->regenerateToken();
	       auth()->user()->tokens()->delete();
           Auth::logout();
		}
        Auth::loginUsingId($user->id, true);
   

        return redirect()->route('admin_index');
    }
    function auth_nuxt(Request $request)
    {
		
        $user = User::where('email', $request->email)->first();
		if (!$user) {
           return response()->json([
            'error' => 'error',
        ]);
			
		}
        if (!Hash::check($request->password, $user->password)) {
              return response()->json([
            'error' => 'error',
        ]);
        }

        Auth::loginUsingId($user->id, true);
        return ['token' => $user->createToken('login')->plainTextToken,'user'=>$user];
      
    }
    function logout(Request $request)
    {
       $user = auth()->user();
	
	 //$request->user()->token()->revoke();
       $request->session()->invalidate();
       $request->session()->regenerateToken();
	   auth()->user()->tokens()->delete();

	   Auth::logout();
	  
	  

        if ($request->lang) {
            return redirect('/' . $request->lang . '/');
        } else {
            return redirect('/');
        }


        //return redirect()->back(); 

    }
}
