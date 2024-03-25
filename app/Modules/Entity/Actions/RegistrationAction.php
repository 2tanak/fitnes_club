<?php
namespace Modules\Entity\Actions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Hash;
use App\Models\User;
//use Modules\Entity\Model\SysUserType\SysUserType;
use Lang;
use Mail;
use Illuminate\Support\Str;
use App\Mail\User\PasworUser;
class RegistrationAction {
    private $model = false;
    private $request = false;
 
	
    function __construct(Model $model, Request $request){
        $this->model = $model; 
        $this->request = $request;
        		
    }

    function run(){
		/*
		создание оандомного пароля
		Str::randpm(10);
		Hash::make(Str::randpm(10));
		*/
        $data = $this->request->all();
	    if ($this->request->password){
			$data['password'] = Hash::make($this->request->password);
		}
        else{
            unset($data['password']);
		}
        $this->model->fill($data);
        $this->model->save();
		//$data = $this->request->all();
		$this->mail($data,$this->request->password);
       return true;exit();
       $key = $this->activateKey($this->request->email);
       $host =	$this->request->root();
	   $link = $host.'/activate/' .$key;
       $body    = 'Вы зарегестрировались на сайте '.$host.'</br>'.'Вам необходимо активировать акаунт по ссылке '.'<a href="'.$link.'">'.$link.'</a>';
	   $data = $this->request->all();
	   $this->mail($data,$body,$host);


        if(isset($this->request->tyr_operator)){$ar['type_id'] = 6;}
		else{
			$ar['type_id'] = 2;
		    
		}
		
		$ar['activate_key'] = $key;
		$this->model->fill($ar);
        $this->model->save();

/*
        $data = new Gid();
        $data->user_id = $this->model->id;
		$data->family = $this->request->family;
		$data->imya = $this->request->name;
		$data->phone = $this->request->phone;

        //$data->edited_user_id = 2;
		$data->save();
        */
		
        
    }
	
	
	
		protected function activateKey($login){
	   	 return md5($login . "|" . uniqid(time()));
	   }
	
	  protected function mail($data,$pass,$body=false,$host=false){
		  
		    Mail::to($data['email'])->send(new PasworUser($pass));
		  /*
		   $result = Mail::send('orda.email.email',['data'=>$data,'body'=>$body], function($message) use ($data,$host) {
			   
				$mail_admin = env('MAIL_ADMIN');
				$message->from($mail_admin, Lang::get('messages.online'));
				$message->to($data['email'],'Mr. Admin')->subject(Lang::get('messages.activate'));
			});
			return true;
			
			*/
			}
  
	protected function create(array $data,$key)
    {
        return User::create([
		    'name' => $data['name'],
            //'login' => $data['login'],
            'email' => $data['email'],
			'gorod' => $data['gorod'],
			'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
			'activate_key'=>$key,
			// New fields
			'last_name' => $data['family'] ? $data['family'] : null,
			'patronymic' => $data['oth'] ? $data['oth'] : null,
			'lang' => $data['lang'] ? $data['lang'] : null,
			'class_id' => $data['class_id'] ? $data['class_id'] : null,
			'smena_id' => $data['smena_id'] ? $data['smena_id'] : null,
        ]);
    }
	
	
	  
	



}