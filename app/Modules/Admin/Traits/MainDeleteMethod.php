<?php
namespace Modules\Admin\Traits;

use Illuminate\Http\Request;
use Modules\Entity\ModelParent;
use RealRashid\SweetAlert\Facades\Alert;
trait MainDeleteMethod  {
	public function delete(Request $request, ModelParent $item) {
	
	    try{
        $action = new $this->action_delete($item, $request);
        $action->run();
        Alert::success('Success delete', 'Success delete');
        return redirect()->route($this->route_path)->with('success', trans('Success delete'));
		}catch(\Illuminate\Database\QueryException $e){
			Alert::error('Errors', $e->getMessage());
			return redirect()->back()->with('error', $e->getMessage());
		}
    }
}