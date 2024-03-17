<?php
/**
 * Created by PhpStorm.
 * User: Viktor
 * Date: 30.09.2019
 * Time: 23:15
 */

namespace App\Services\Route;


use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function register() {
        $this->app->bind("Route", 'App\Services\Route\Routerclass');
    }
}