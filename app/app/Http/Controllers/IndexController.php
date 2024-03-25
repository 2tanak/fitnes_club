<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use App\Events\NewEventAded;

//use App\Http\Requests;
//use App\Events\NewMessage;
//use App\Events\ShutEvent;
//use App\Events\Privates;
//use App\Events\Echoserverpublic;
//use App\Events\Echoserverprivat;
//use App\Events\Echoevent;

//use App\Events\Chat2;
//use App\Events\RedisEvent;
//use App\Events\Ktoonline;
//use App\Jobs\SendMessage;
//use App\Jobs\PrepareJob;
//use App\Jobs\PublishJob;
//use Redis;
//use DB;
//use App\Message;
//use App\Room;

class IndexController extends Controller
{
	protected $vars = array();
	public function __construct()
	{
		$this->template = 'index';
	}


	public function index()
	{
		return view('simple.index');
	}
	public function peredacha()
	{
		$arr = [
			array('title' => 'devepoper', 'url' => 'thhp://c.ru'),
			array('title' => 'devepoper2', 'url' => 'thhp://c.ru2'),

		];

		$content = view('simple.peredacha', compact('arr'))->render();

		$this->vars['content'] = $content;
		//$this->vars = array_add($this->vars,'content', $content);
		return view($this->template)->with($this->vars);
	}

	public function ajax2()
	{
		$arr = [
			array('title' => 'devepoper', 'url' => 'thhp://c.ru'),
			array('title' => 'devepoper2', 'url' => 'thhp://c.ru2'),

		];

		return $arr;
	}


	public function ajax()
	{


		$content = view('simple.ajax')->render();

		$this->vars['content'] = $content;
		//$this->vars = array_add($this->vars,'content', $content);
		return view($this->template)->with($this->vars);
	}
}
