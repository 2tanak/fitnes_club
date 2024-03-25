<?php
namespace Modules\Entity\Actions\Statistics;

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
		$array=[];
		$array['yanvar']=['month'=>'январь','uid'=>1];
		$array['fevral']=['month'=>'февраль','uid'=>2];
		$array['mart']=['month'=>'март','uid'=>3];
		$array['aprel']=['month'=>'апрель','uid'=>4];
		$array['mai']=['month'=>'mai','uid'=>5];
		$array['iyun']=['month'=>'июнь','uid'=>6];
		$array['iyul']=['month'=>'июнь','uid'=>7];
		$array['avgust']=['month'=>'август','uid'=>8];
		$array['sentyabr']=['month'=>'сентябрь','uid'=>9];
		$array['oktyabr']=['month'=>'октябрь','uid'=>10];
		$array['noyabr']=['month'=>'ноябрь','uid'=>11];
		$array['dekabr']=['month'=>'декабрь','uid'=>12];
		
		
		
		
		$ar['user_id'] = $this->request->user()->id;
    	$ar['edited_user_id'] = $this->request->user()->id;
        if(!isset($ar['active'])){
			$ar['active'] = '0';
		}
		 if(isset($ar['month'])){
			
			$ar['slug'] = $array[$ar['month']]['month'];
			$ar['uid'] = $array[$ar['month']]['uid'];
		}
	 	if ($this->request->has('photo')){
		
			if(isset($this->model->files->id)){
			Storage::disk('public')->delete($this->model->files->small);
			Storage::disk('public')->delete($this->model->files->medium);
			Storage::disk('public')->delete($this->model->files->large);
			Storage::disk('public')->delete($this->model->files->extralarge);
			$this->model->files()->delete();
			}
			$file = UploadPhoto::upload($this->request->photo,$this->model->photo);
			$this->model->files()->associate($file)->save();
		}else{
			 unset($ar['photo']);
		}
       
		$this->model->fill($ar);
		
         $this->model->save();
		
    }


   
 

  
}