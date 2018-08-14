<?php
/**
 * Created by PhpStorm.
 * User: externaldev
 * Date: 14.08.18
 * Time: 09:51
 */

namespace DemoSDK\Models;
use Plenty\Modules\Plugin\DataBase\Contracts\Model;

class ToDo extends Model{

    public $id =0;
    public $name = '';
    public $createdById = 0;
    public $createdForId = 0;
    public $isDone = false;
    public $createdAt =0;

    public function getTableName(){
        return 'DemoSDK::ToDo';
    }


}