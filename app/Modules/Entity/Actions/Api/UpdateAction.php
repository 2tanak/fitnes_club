<?php
namespace Modules\Entity\Actions\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Services\UploadPhoto;
use Storage;
use Route;
use Cache;
class UpdateAction {
    private $model = false;
    private $request = false;

    function __construct(Model $model, Request $request){
		
        $this->model = $model; 
        $this->request = $request; 
    }

    function run(){
		
        return $this->saveMain();
		//$this->saveLang();
      
    }

    private function saveMain(){
	
        $ar = $this->request->all();
		
		$ar['user_id'] = $this->request->user()->id;
    	$ar['edited_user_id'] = $this->request->user()->id;

	 	if ($this->request->has('photo')){
		
			if(isset($this->model->files->id)){
			Storage::disk('public')->delete($this->model->files->small);
			Storage::disk('public')->delete($this->model->files->medium);
			Storage::disk('public')->delete($this->model->files->large);
			Storage::disk('public')->delete($this->model->files->extralarge);
			Storage::disk('public')->delete($this->model->files->size_2000);
			$this->model->files()->delete();
			}else{
				
			}
			$file = UploadPhoto::upload($this->request->photo,$this->model->photo);
			$this->model->files()->associate($file)->save();
		}else{
			 unset($ar['photo']);
		}
       
		$this->model->fill($ar);
		
         $this->model->save();
		return $this->model;
    }


   
 

  
}