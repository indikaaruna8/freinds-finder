<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace In\Json;

use Lib\In\ListBundle\Util\JsonEntity;
use In\Entity\Admin;

/**
 * Description of AdminJson
 *
 * @author indika
 */
class AdminJson extends JsonEntity
{

    /**
     * 
     * @var Admin
     */
    protected $entity;

    public function getCreatedDate($format)
    {
        return $this->entity->getCreatedAt()->format($format);
    }

}
