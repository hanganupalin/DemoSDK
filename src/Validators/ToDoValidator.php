<?php
/**
 * Created by PhpStorm.
 * User: externaldev
 * Date: 14.08.18
 * Time: 10:07
 */
namespace DemoSDK\Validators;

use Plenty\Validation\Validator;

/**
 *  Validator Class
 */
class ToDoValidator extends Validator
{
    protected function defineAttributes()
    {
        $this->addString('name', true);
    }
}
