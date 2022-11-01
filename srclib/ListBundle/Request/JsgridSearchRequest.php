<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Lib\In\ListBundle\Request;

use Lib\In\ListBundle\Interfaces\SearchRequesInterface;
use Lib\In\ListBundle\Util\SearchFilters;

/**
 * Description of JsgridSearchRequest
 *
 * @author indika
 */
class JsgridSearchRequest implements SearchRequesInterface
{

    public function getFilters(): SearchFilters
    {
        $filter = new SearchFilters();

        return $filter;
    }

}
