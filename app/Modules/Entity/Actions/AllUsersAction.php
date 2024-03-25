<?php
namespace Modules\Entity\Actions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\Services\UploadPhoto;
use Hash;
use App\User;
use Modules\Entity\Model\SysUserType\SysUserType;

class AllUsersAction {
    private $model = false;
    private $request = false;
    public $type = false;

    function __construct(Model $model, Request $request){
        $this->model = $model; 
        $this->request = $request; 
    }

    function run(){
        $ar = $this->request->all();
        $ar['edited_user_id'] = $this->request->user()->id;
		$ar['activator'] = 'active';
		//$ar['type_id'] = SysUserType::USERS;
        if($this->request->type_id){
		$ar['type_id'] = $this->request->type_id;
        }else{
			unset($ar['type_id']);
		}

        
        
        if ($this->request->has('photo'))
            $ar['photo'] = UploadPhoto::upload($this->request->photo);
        else 
            unset($ar['photo']);

        if ($this->request->password)
            $ar['password'] = Hash::make($this->request->password);
        else
            unset($ar['password']);

     

        $this->model->fill($ar);
        $this->model->save();


    }

}