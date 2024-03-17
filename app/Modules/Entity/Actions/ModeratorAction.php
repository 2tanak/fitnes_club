<?php
namespace Modules\Entity\Actions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\Services\UploadPhoto;
use Hash;
use App\User;
use Modules\Entity\Model\SysUserType\SysUserType;

class ModeratorAction {
    private $model = false;
    private $request = false;

    function __construct(Model $model, Request $request){
        $this->model = $model; 
        $this->request = $request; 
    }

    function run(){
        $ar = $this->request->all();
        $ar['edited_user_id'] = $this->request->user()->id;
		$ar['type_id'] = SysUserType::MODERATOR;
        $ar['activator'] = 'active';

        
        
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