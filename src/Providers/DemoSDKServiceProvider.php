<?php
/**
 * Created by PhpStorm.
 * User: externaldev
 * Date: 14.08.18
 * Time: 08:09
 */
namespace DemoSDK\Providers;


use Plenty\Plugin\ServiceProvider;
use DemoSDK\Repositories\ToDoRepository;
use DemoSDK\Contracts\ToDoRepositoryContract;


class DemoSDKServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     */

    public function register()
    {
        $this->getApplication()->register(DemoSDKRouteServiceProvider::class);
        $this->getApplication()->bind(ToDoRepositoryContract::class ,ToDoRepository::class);
    }
}