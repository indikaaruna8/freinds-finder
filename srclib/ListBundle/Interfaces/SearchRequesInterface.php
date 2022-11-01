<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPInterface.php to edit this template
 */

namespace Lib\In\ListBundle\Interfaces;

use Lib\In\ListBundle\Util\SearchFilters;

/**
 *
 * @author indika
 */
interface SearchRequesInterface
{
    public function getFilters(): SearchFilters;
}
