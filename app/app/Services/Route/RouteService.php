<?php
/**
 * Created by PhpStorm.
 * User: Viktor
 * Date: 30.09.2019
 * Time: 23:14
 */

namespace App\Services\Route;


use Illuminate\Support\Facades\Facade;

class RouteService extends Facade
{
    protected static function getFacadeAccessor() {
        return "Route";
    }
}