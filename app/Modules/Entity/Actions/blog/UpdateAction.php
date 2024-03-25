<?php
namespace Modules\Entity\Actions\Blog;

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
        $this->saveMain();
		//$this->saveLang();
        //$this->saveSights();
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
			$this->model->files()->delete();
			}
			$file = UploadPhoto::upload($this->request->photo,$this->model->photo);
			$this->model->files()->associate($file)->save();
		}
       
		$this->model->fill($ar);
		
         $this->model->save();
		
    }


   
 

  
}