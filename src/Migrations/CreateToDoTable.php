<?php
/**
 * Created by PhpStorm.
 * User: externaldev
 * Date: 14.08.18
 * Time: 09:57
 */

namespace DemoSDK\Migrations;

use DemoSDK\Models\ToDo;
use Plenty\Modules\Plugin\DataBase\Contracts\Migrate;

/**
 * Class CreateToDoTable
 */
class CreateToDoTable
{
    /**
     * @param Migrate $migrate
     */
    public function run(Migrate $migrate)
    {
        $migrate->createTable(ToDo::class);
    }
}