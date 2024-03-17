<?php

namespace App\Helper;
use Illuminate\Http\Request;
use App\Helper\CurrentLang;

class Url {
  public function get($uri) {
    $locale = app()->getLocale();
     $locale = request()->segment(1, '');
	$reverse = array_flip(CurrentLang::getAr());
    if($locale && in_array($locale, $reverse)) {
        $url = str_replace("/".$_SERVER['HTTP_HOST'], "/".$_SERVER['HTTP_HOST'].'/'.$locale, $uri);
     return $url;
     }
     return $uri;
    
}
}