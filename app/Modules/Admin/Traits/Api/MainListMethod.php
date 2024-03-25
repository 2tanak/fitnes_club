<?php
namespace Modules\Admin\Traits\Api;

use Illuminate\Http\Request;
use Modules\Entity\Model\Uslugi\Model as Uslugi;
use Modules\Entity\Model\Otzyv\Model as Otzyv;
use Modules\Entity\Model\Portfolio\Model as Portfolio;
use Modules\Entity\Model\Blog\Model as Blog;
use Modules\Entity\Model\Instrukcii\Model as Instrukcii;
use Modules\Entity\Model\Vakansiya\Model as Vakansiya;
use Modules\Entity\Model\Comanda\Model as Comanda;
use Modules\Entity\Model\Slider2\Model as Slider2;
use Modules\Entity\Model\Konstrukciya\Model as Konstrukciya;
use Modules\Entity\Model\Option\Model as Option;
use Modules\Entity\Model\Region\Model as Region;
use Modules\Entity\Model\Contacts\Model as Contacts;
use Modules\Entity\Model\Price\Model as Price;
use Modules\Entity\Model\Statistics\Model as Statistics;
use Modules\Entity\Model\Portfolio\Category\Model as CategoryPortfolio;
use App\Models\User;
use App\Models\Period;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Entity\ModelParent;
use Modules\Entity\Model\Hearts\Model as Hearts;
use Modules\Entity\Model\Month\Model as Month;
//use Modules\Entity\Model\Price\Model as Price;
trait MainListMethod  {
	
	

    public function index(Request $request) {
		
		$proxy = \Request::create('/api/user', 'get', ['user_id'=>$request->user_id]);
        $resp = json_decode(app()->handle($proxy)->getContent());
		$response =[];
	    if((int) $resp->id === (int) $request->user_id && $resp->id != 1 ){
		
			$items = $this->def_model::filter($request)->get();
			$response['items'] = $items->count() > 0 ? $items : [];
			$response['user_id'] = $resp->id;
			if(isset($request->kart_atribute)){
			  foreach($request->kart_atribute as $atribute){
				$proxy = \Request::create('/api/admin/'.$atribute.'/proxy', 'get', ['user_id'=>$request->user_id]);
				$attr = json_decode(app()->handle($proxy)->getContent());
				$response[$atribute] = $attr;
			  }
			 }
           }
		return $response;
	  }
	  
	  
		public function proxy(Request $request) {
		return $this->def_model::filter($request)->get();
	    }
	
	
	
}







