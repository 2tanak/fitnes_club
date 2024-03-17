<?php
namespace Modules\Entity\Model\SysUserType;

use Illuminate\Database\Eloquent\Model;

class SysUserType extends Model {
    protected $table = 'sys_user_type';

    CONST ADMIN = 1;
    CONST MANAGER = 5; 
	CONST GID = 2; 
	CONST TYROPERATOR = 6; 
    CONST MODERATOR = 3; 
    CONST USER = 4; 
 static function getRole($role){
        $search= array_search($role,['ADMIN'=>1,'MANAGER'=>5,'GID'=>2,'MODERATOR'=>3,'USER'=>4,'TYROPERATOR'=>6]);
		if($search){return $search;}
		return false;
    }
	
static function listRole(){
		 return [5=>'MANAGER',2=>'GID',3=>'MODERATOR',4=>'USER',6=>'TYROPERATOR'];
		 
	 }

	

	
	
    static function getAr(){
        return static::pluck('name', 'id')->toArray();
    }
}
