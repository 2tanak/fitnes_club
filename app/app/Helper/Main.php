<?php 
use App\Helper\CurrentLang;

function lroute($route, $param = null){
    $lang = CurrentLang::get();

    if (is_array($param))
        array_unshift($param, $lang);
    else if (!$param)
        $param = $lang;
    else 
        $param = [$lang, $param];

    return route($route, $param);
}

function fileLink($v){
	
    if (!$v || $v == '' || trim($v) == '')
        return '/admin-asset/assets/images/placeholder.jpg';

    return env('FILE_SERVER_URL').'/'.$v;
}

function checkFilterParam($request){
	
    $url = $request->url();
    $ar_param = $request->all();

    if (count($ar_param) > 0 && ($request->save_filter == 1 || $request->page > 0)){
        
        $saved = str_replace("save_filter=1", "", $request->fullUrl());

        session(['filter_'.$url => $saved]);
        session()->save();

        return false;
    }

    if ($request->clear_filter == 1){
        session()->forget('filter_'.$url);
        session()->save();

        return redirect()->to($url);
    }

    if (count($ar_param) == 0 && session('filter_'.$url)) {
        return redirect()->to(session('filter_'.$url));
    }


    return false;
}