<?php

namespace Modules\Admin\Traits;

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
//use App\Models\Option;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

trait MainListMethod
{
	
	public function test1542(Request $request)
	{
	//$result = json_decode(app()->handle(\Request::create('/api/banners', 'get', ['page'=>1,'konstrukcii'=>['kryshnaya konstrukciya','mediafasad ekran'],'month'=>['yanvar','mart'],'svet'=>'yes']))->getContent());
	$result = json_decode(app()->handle(\Request::create('/api/banners', 'get', ['page'=>1,'statica'=>'yes']))->getContent());
	dd($result->data);
	
		//$category= Konstrukciya::pluck('name', 'slug')->toArray();
		//return $category;
	   //return json_encode(['number'=>600]);
	}
	
	public function index(Request $request)
	{
	    $items = $this->def_model::filter($request)->latest()->paginate(20);
		$title = trans($this->title_path . '.index');
		return view($this->view_path . '.index', [
			'title' => $title,
			'items' => $items
		]);
	}
	public function index_nuxt(Request $request)
	{
        
		$request = $this->filter($request);
		
		$items = $this->def_model::filter($request);
		//dd($items->toSql());
		if (isset($request->with)) {
			$items->with($request->with);
		}
		if (isset($request->orderBy)) {
			$items->orderBy($request->orderBy, $request->naprv);
		}
		if (isset($request->banners)) {
		
			if ($request->page == 1) {
				return $items->get();
			} else {
				$paginate = $request->page;
				return $items->latest()->paginate(30);
			}
		}
		if (isset($request->page)) {
		
			$paginate = $request->page;
			return $items->latest()->paginate($request->paginate);
		} else {
		
			return $items->get();
		}
	}

	public function index_ajax(Request $request)
	{
		$result = $this->def_model::filter($request)->orderBy('id', 'asc')->get();
		return $result;
	}
	
	public function update_client(Request $request){
		
		$blog = new $this->def_model();
		//dd($blog);
		Option::updateOrCreate(['key_id' => $request->q], ['key_id' => $request->q, 'value' => true]);
		Alert::success('Создана подписка клиентов на обновление', '');
		return redirect()->back();
		//dd($request->q);
		
	}
	public function get_option(Request $request){
		$data = $request->all();
		//return array_keys($data);
		$option = Option::whereIn('key_id',array_keys($data))->get();
		return $option;
	}
	public function question(Request $request)
	{
		$plan = $request->forma;
		$account = $request->account;
		$personal_data = $request->account['personal_data'];

		//return $request->account;



		//контактные данные
		if ($personal_data['otvet']['name']) {
			$name = $personal_data['otvet']['name'];
		}
		if ($personal_data['otvet']['phone']) {
			$phone = $personal_data['otvet']['phone'];
		}
		if ($personal_data['otvet']['email']) {
			$email = $personal_data['otvet']['email'];
		}

		//проверка юзера в базе или создание юзера в базе
		if ($email || $phone) {

			$user = User::where('email', $email)->first();

			if (!$user) {
				$user = User::where('phone', $phone)->first();
			}
			if (!$user) {
				$user = User::create([
					'name' => $name,
					'email' => $email,
					'password' => Hash::make(Str::random(12))
				]);
			}
		}

		//создаем опции для юзера
		$user->optionsable()->updateOrCreate(['optionable_id' => $user->id, 'kkey' => 'plan'], ['kkey' => 'plan', 'value' => $plan]);
		$user->optionsable()->updateOrCreate(['optionable_id' => $user->id, 'kkey' => 'contact'], ['kkey' => 'contact', 'value' => json_encode($personal_data['otvet'])]);



		$question = new $this->def_model();
		return $question;
		$question->updateOrCreate(['plan' => $key], ['question' => 'hhhhhhhhh']);
		return 14;
		foreach ($request->account as $key => $data) {
			$question->updateOrCreate(['plan' => $key, 'user_id' => $user->id], ['question' => 'hhhhhhhhh']);
		}
		return 4444;





		return $personal_data['personal_data']['otvet']['email'];

		return $account;
		//массив с месяцами размещения рекламы
		$format = $request->format;
		$itog = $request->itog;
		return $itog;
		return $format;
		if ($format === 'full') {
			return 1;
		} else {
			return 2;
		}
		$month = $request->month_mesta['forms']['select']['month']['input'];


		return $request->all()['month_mesta']['forms']['select']['month']['input'];
	}
	
	
	public function multi(Request $request)
	{
		$arr = [];
		/*
       if (filter_var($request->input('otzyv'), FILTER_VALIDATE_BOOLEAN) === true) {
		
			$otzyv = json_decode(app()->handle(\Request::create('/api/otzyv', 'get'))->getContent());
			$arr['otzyv'] = $otzyv;
		}
		if (filter_var($request->input('blog'), FILTER_VALIDATE_BOOLEAN) === true) {
			if(isset($request->bind)) {
				$bind = json_decode($request->bind);
				if (isset($bind->blog->page)) {
					$request->request->add(['page' => $bind->blog->page]);
					if(isset($bind->blog->paginate)){
					$request->request->add(['paginate' => $bind->blog->paginate]);
					}
				}
			}
			$blog = json_decode(app()->handle(\Request::create('/api/blog', 'get', $request->all()))->getContent());
			$arr['blog'] = $blog;
		}
	if (filter_var($request->input('vakansiya'), FILTER_VALIDATE_BOOLEAN) === true) {
			if(isset($request->bind)) {
				$bind = json_decode($request->bind);
				if (isset($bind->vakansiya->page)) {
					$request->request->add(['page' => $bind->vakansiya->page]);
					if(isset($bind->vakansiya->paginate)){
					$request->request->add(['paginate' => $bind->vakansiya->paginate]);
					}
				}
			}
			$res = json_decode(app()->handle(\Request::create('/api/vakansiya', 'get',$request->all()))->getContent());
			$arr['vakansiya'] = $res;
		}
		if (filter_var($request->input('instrukcii'), FILTER_VALIDATE_BOOLEAN) === true) {
			if(isset($request->bind)) {
				$bind = json_decode($request->bind);
				if (isset($bind->instrukcii->page)) {
					$request->request->add(['page' => $bind->instrukcii->page]);
					if(isset($bind->instrukcii->paginate)){
					$request->request->add(['paginate' => $bind->blog->paginate]);
					}
				}
			}
			$instrukcii = json_decode(app()->handle(\Request::create('/api/instrukcii', 'get'))->getContent());
			$arr['instrukcii'] = $instrukcii;
		}
		if (filter_var($request->input('slider'), FILTER_VALIDATE_BOOLEAN) === true) {
			$slider = json_decode(app()->handle(\Request::create('/api/slider', 'get'))->getContent());
			$arr['slider'] = $slider;
		}
		
		if (filter_var($request->input('category_portfolio'), FILTER_VALIDATE_BOOLEAN) === true) {
            if(isset($request->bind)) {
				$category_portfolio = json_decode($request->bind);
				if (isset($category_portfolio->page)) {
					$request->request->add(['page' => $category_portfolio->category_portfolio->page]);
					$request->request->add(['paginate' => 3]);
				}
			}
			$cat_portfolio = json_decode(app()->handle(\Request::create('/api/category-portfolio', 'get', $request->all()))->getContent());
			$arr['category_portfolio'] = $cat_portfolio;
		}
		
		if (filter_var($request->input('portfolio'), FILTER_VALIDATE_BOOLEAN) === true) {
			if(isset($request->bind)) {
				$bind = json_decode($request->bind);
				if (isset($bind->portfolio->page)) {
					$request->request->add(['page' => $bind->portfolio->page]);
					if(isset($bind->portfolio->paginate)){
					$request->request->add(['paginate' => $bind->portfolio->paginate]);
					}
					if(isset($bind->portfolio->cat_id)){
						if($bind->portfolio->cat_id != null){
						$request->request->add(['cat_id' => $bind->portfolio->cat_id]);
						}
					}
				}
			}
			
			$portfolio = json_decode(app()->handle(\Request::create('/api/portfolio', 'get', $request->all()))->getContent());
			$arr['portfolio'] = $portfolio;
			$arr['test'] = $request->all();
		}
		if (filter_var($request->input('comanda'), FILTER_VALIDATE_BOOLEAN) === true) {
			$comanda = json_decode(app()->handle(\Request::create('/api/comanda', 'get'))->getContent());
			$arr['comanda'] = $comanda;
		}

		if (filter_var($request->input('price_popular'), FILTER_VALIDATE_BOOLEAN) === true) {
			$price = json_decode(app()->handle(\Request::create('/api/price', 'get'))->getContent());
			$arr['price'] = $price;
		}
		
		if (filter_var($request->input('konstrukciya'), FILTER_VALIDATE_BOOLEAN) === true) {
			$konstrukciya = json_decode(app()->handle(\Request::create('/api/konstrukciya', 'get'))->getContent());
			$arr['konstrukciya'] = $konstrukciya;
		}
		if (filter_var($request->input('contacts'), FILTER_VALIDATE_BOOLEAN) === true) {
			$contacts = json_decode(app()->handle(\Request::create('/api/contacts', 'get'))->getContent());
			$arr['contacts'] = $contacts;
		}
*/
		if (filter_var($request->input('banners'), FILTER_VALIDATE_BOOLEAN) === true) {
            
			$banners = json_decode(app()->handle(\Request::create('/api/banners', 'get', $request->all()))->getContent());
			if($banners){
				if(is_array($banners)){
			$level_banners = collect($banners)->groupBy('raion');
			$level_banners = $level_banners->diffKeys(["" => array()])->keys();
			$arr['level_banners'] = $level_banners;
				}
			}
			
			$arr['banners'] = $banners;
			
			$arr['page'] = $request->page;
			//$arr['request'] = $request;
		}
		/*
		if (filter_var($request->input('uslugi'), FILTER_VALIDATE_BOOLEAN) === true) {
			$uslugi = json_decode(app()->handle(\Request::create('/api/uslugi', 'get'))->getContent());
			$arr['uslugi'] = $uslugi;
		}

*/


		if (filter_var($request->input('statistics'), FILTER_VALIDATE_BOOLEAN) === true) {

			$statistics = json_decode(app()->handle(\Request::create('/api/statistics', 'get', ['orderBy' => 'name', 'naprv' => 'desc']))->getContent());
			$statistics = collect($statistics)->where('active', '=', '1')->slice(0, 4)->values();
			$first = $statistics[0]->name;
			if (isset($statistics[0])) {
				$statistics[0]->statistics = 100;
			}
			if (isset($statistics[1])) {
				$two = $statistics[1]->name;
				$two = (int) round(($two / $first) * 100, 0);
				$statistics[1]->statistics = $two;
			}
			if (isset($statistics[2])) {
				$three = $statistics[2]->name;
				$three = (int) round(($three / $first) * 100, 0);
				$statistics[2]->statistics = $three;
			}
			if (isset($statistics[3])) {
				$four = $statistics[3]->name;
				$four = (int) round(($four / $first) * 100, 0);
				$statistics[3]->statistics = $four;
			}

			$arr['statistics'] = $statistics;
		}
       


		return $arr;
	}

	public function bannersList(Request $request)
	{
		$limit = 4000;

		$banner = $this->def_model::filter($request)->orderBy('id', 'asc')->take($limit)->get();
		//$raion = $banner->groupBy(['raion'], $preserveKeys = true);
		$level_banners = $banner->groupBy('raion');

		$level_banners = $level_banners->diffKeys(["" => array()])->keys();
		$level_banners = collect($level_banners);
		$konstrukciya = Konstrukciya::class;
		//$option= Option::class;
		//$region= Region::class;
		$uslugi = Uslugi::class;
		$contacts = Contacts::class;

		$portfolio_cat = CategoryPortfolio::class;

		$portfolio_cat = $portfolio_cat::with(['files'])->filter($request)->orderBy('id', 'asc')->get();

		$uslugi = $uslugi::with(['files', 'sliders'])->filter($request)->orderBy('id', 'asc')->get();

		$contacts = $contacts::filter($request)->orderBy('id', 'asc')->get();
		$konstrukciya = $konstrukciya::filter($request)->orderBy('id', 'asc')->get();
		//$option= $option::filter($request)->orderBy('id','asc')->get();
		//$region= $region::filter($request)->orderBy('id','asc')->get();
		$arr = ['banner' => $banner, 'konstrukciya' => $konstrukciya, 'uslugi' => $uslugi, 'contacts' => $contacts, 'level_banners' => $level_banners, 'portfolio_cat' => $portfolio_cat];
		//$arr=['banner'=>$banner];
		return $arr;
	}
	public function filter(Request $request)
	{
		
        //
		if (isset($request->periud)) {
			$periud = $request->periud;
			//$request->request->add(['month' => $periud]);
			
			if (!is_array($request->periud)) {
				$periud = explode(',', $periud);
			} else {
				$periud = $request->periud;
			}
			$request->request->add(['month' => $periud]);
			
			
		}

		
/*
		if (isset($request->uslovie)) {
			if (!is_array($request->uslovie)) {
				$uslovie = explode(',', $request->uslovie);
			} else {
				$uslovie = $request->uslovie;
			}


			if (in_array('svet', $uslovie)) {
				$request->request->add(['svet' => 'Да']);
			}
			if (in_array('storona', $uslovie)) {

				$request->request->add(['storona_a' => 'А']);
			}
			if (in_array('statica', $uslovie)) {

				$request->request->add(['statica' => 'статич']);
			}
			if (in_array('number', $uslovie)) {
				$request->request->add(['number' => 'цифровой']);
			}
		}
		*/
		if (isset($request->arenda)) {
			$arenda = explode(',', $request->arenda);
			$request->request->add(['min_price_arenda' => $arenda[0]]);
			$request->request->add(['max_price_arenda' => $arenda[1]]);
			//return $request->all();
		}

		if (isset($request->naselennyi_punkt)) {
			$request->request->add(['naselennyi_punkt' => $request->naselennyi_punkt]);
		}


		return $request;
	}
	public function formats(Request $request)
	{
		//depreceted
		if ($request->query('page')) {
			$paginate = $request->page;
		}

		$resuit = $this->def_model::filter($request)->latest()->paginate(14);
		return $resuit;
	}

	public function skils(Request $request)
	{
		return 25;
	}
}
