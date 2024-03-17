<?php

namespace Modules\Admin\Traits;

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
	public function create(Request $request)
	{

		$general = false;
		if ($request->general) {
			$general = $request->general;
		}

		return view($this->view_path . '.create', [
			'general' => $general,
			'title' => trans($this->title_path . '.create'),
			'ar_bread' => [
				route($this->route_path) => trans($this->title_path . '.index')
			]
		]);
	}
	
	public function saveCreate(Request $request)
	{
       
		try {
		   
           $validator = $this->validator($request->all());
			if ($validator->fails()) {
				Alert::error('Validation errors', 'Check the fields');
				return redirect()->back()->withErrors($validator);
			};
		} catch (\Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
		}

		$action = new $this->action_create(new $this->def_model(), $request);

		try {
			$action->run();
		} catch (\Exception $e) {
			Alert::error('Errors', $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
		}
		
		Alert::success('success', 'Успешно создано');

		return redirect()->route($this->route_path)->with('success', trans('main.created_model'));
	}
   
}
