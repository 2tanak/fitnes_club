<?php

namespace App\Helper\Facades;

use Illuminate\Support\Facades\Facade;

class Translit extends Facade {
	
	
	protected static function getFacadeAccessor() {
		return 'translit';
	}
	
}

