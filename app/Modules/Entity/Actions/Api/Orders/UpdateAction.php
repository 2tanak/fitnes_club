<?php
namespace Modules\Entity\Actions\Api\Orders;

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
		return $this->saveProducts();
      
    }

    private function saveMain(){
	 
	    $ar = (array) json_decode($this->request->order)[0];
	    $this->model->fill($ar);
	    $this->model->save();
		
    }


     private function saveProducts(){
		 
		 $products = json_decode($this->request->products);
		 $collection = collect($products);
		 $model_order =$this->model;
		 $orders_product = $collection->transform(function ($item, $key) use($model_order){
			$item->order_id = $model_order->id;
            return (array )$item;
         });
		
         $this->model->products()->upsert([... $orders_product],[ 'order_id', 'user_id' ]);
		 return $this->model;
	 }
 

  
}