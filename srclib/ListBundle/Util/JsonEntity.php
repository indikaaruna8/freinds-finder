<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Lib\In\ListBundle\Util;

/**
 * Description of Entity
 *
 * @author indika
 */
class JsonEntity
{
    protected $entity;

    public function __construct($entity)
    {
        $this->entity = $entity;
    }

    public function __call($name, $args)
    {
        if (method_exists($this->entity, $name)) {
            $val = call_user_func_array([$this->entity, $name], $args);
            if (is_null($val)) {
                'N/A';
            }

            return $val;
        }

        return false;
    }
}
