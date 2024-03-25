<?php
namespace Modules\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Modules\Entity\Traits\DateHelper;
use Modules\Entity\Traits\FilterModel;
use Modules\Entity\Traits\RoleModel;
use Modules\Entity\Traits\ChangeModel;

use Modules\Entity\Traits\LabelModel;
use Route;
use App\Helper\CurrentLang;
use Cache;
class ModelParent extends Model {
    //use DateHelper, RoleModel, FilterModel, LabelModel, ChangeModel;
	use FilterModel;

    protected $lang = false;
    //use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
		
        $this->lang = CurrentLang::url();
    }

    public function setLocale($locale = false){
		
        if (!$locale){
            $this->lang = 'ru';
		}
        //CurrentLang::set($locale);
        $this->lang = $locale;
    }

    protected function getTransField($field, $v){
		
		
		$lang = CurrentLang::url();
		
		$route = Route::currentRouteName();
		$ar=explode('_',$route);
        if(in_array('create',$ar)){
         return $v;
		}
		
		if($lang!=false){
			if($lang){
				$this->lang = $lang;
			}
			
		}
		
		 if ($this->lang == '' || $this->lang == 'ru'){
            return $v;
		 }
		
		 if(!isset($this->id)){
			 return $v;
		 }
			 
		
		$table_name = $this->getTable();
       
        if (strpos($table_name, 'lib_') !== false || strpos($table_name, 'general') !== false){
			
            $lang = $this->relTrans()->where(['lang'=>$this->lang])->first();
            if (!$lang){
                $lang =  $this->relTrans()->updateOrCreate([
                    'lang' => $this->lang,
                    'table_name' => $table_name,
                    'el_id' => $this->id
                ], ['lang' => $this->lang, 'table_name' => $table_name]);
            }
            
        }
        else{
			 $lang = Cache::get($lang.$this->getNameSpace());
		 //$lang = $this->relTrans()->firstOrCreate(['lang'=>$this->lang]);
		 /*
		 $lang = Cache::rememberForever($lang.$this->getNameSpace(), function () {
			return $this->relTrans()->firstOrCreate(['lang'=>$this->lang]);
          });
		  */
		}
		
        if (!isset($lang->{$field})) {
            return $v;
		}

        return $lang->{$field};
    }

    function getTitleAttribute(){
        return $this->getTable();
    }

}
