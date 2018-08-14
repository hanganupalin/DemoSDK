<?php
/**
 * Created by PhpStorm.
 * User: externaldev
 * Date: 14.08.18
 * Time: 08:09
 */

namespace DemoSDK\Providers;


use Plenty\Plugin\RouteServiceProvider;
use Plenty\Plugin\Routing\Router;

class DemoSDKRouteServiceProvider extends RouteServiceProvider
{
    public function map(Router $router)
    {
        $router->get('external','DemoSDK\Controllers\ContentController@seyHi');
        $router->get('todo', 'DemoSDK\Controllers\ContentController@showToDo');
        $router->post('todo', 'DemoSDK\Controllers\ContentController@createToDo');
        $router->put('todo/{id}', 'DemoSDK\Controllers\ContentController@updateToDo')->where('id','\d+');
        $router->delete('todo/{id}', 'DemoSDK\Controllers\ContentController@removeToDo');
    }
}
