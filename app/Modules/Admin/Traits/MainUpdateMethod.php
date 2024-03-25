<?php
namespace Modules\Admin\Traits;

use PageService;
use App\Helper\CurrentLang;
use Illuminate\Http\Request;
use Modules\Entity\ModelParent;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Modules\Admin\Http\Requests\UniverRequest;

trait MainUpdateMethod  {
	
	
	public function update(Request $request, ModelParent $item)
	{
		
		$general = false;
		
		if ($request->general) {
			$general = $request->general;
		}


		if ($request->lang == 'ru' || !isset($request->lang)) {
			
			\App::setLocale('ru');
		}
        
       
		$title = trans($this->title_path . '.update');
		
		

		return view($this->view_path . '.update', [
			'general' => $general,
			'title' => $title,
			'ar_bread' => [
				//route($this->route_path) => trans($this->title_path.''),
				route($this->route_path) => trans($this->title_path . '.index'),

			],
			'model' => $item
		]);
	}
  public function saveUpdate(Request $request, ModelParent $item)
	{
		try {

			$validator = $this->validator($request->all(), $item);
			if ($validator->fails()) {

				Alert::error('Validation errors', 'Check the fields');
				return redirect()->back()->withErrors($validator);
			};
		} catch (\Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
		}

		if (CurrentLang::get() && CurrentLang::get() != 'ru') {
			//dd($request->all());
			
		  $model = $item->relTrans()->updateOrCreate(['lang'=>$request->lang],$request->all());
		  Cache::forget($request->lang.$item->getNameSpace());
		  Cache::rememberForever($request->lang.$item->getNameSpace(), function () use($model){
			return $model;
			});
		} else {
			$model = $item;
			$action = new $this->action_update($model, $request);
		
         try {
			
			$action->run();
			
		} catch (\Exception $e) {
			Alert::error('Errors', $e->getMessage());
			return redirect()->back()->with('error', $e->getMessage());
		}
        }


		Alert::success('Successfully updated', 'Successfully updated');

		if ($request->lang) {

			return redirect()->route($this->route_path . '_update', $item->id . '?lang=' . $request->lang)->with('success', trans('main.updated_model'));
		} else {

			return redirect()->route($this->route_path . '_update', $item)->with('success', trans('main.updated_model'));
		}
		
	}
}