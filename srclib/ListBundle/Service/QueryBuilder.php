<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Lib\In\ListBundle\Service;

use Lib\In\ListBundle\Interfaces\QueryBuilderInterface;
use Lib\In\ListBundle\Util\SearchFilters;

/**
 * Description of QueryBuilder
 *
 * @author indika
 */
class QueryBuilder implements QueryBuilderInterface
{

    private SearchFilters $scarchFilter;

    public function setScarchFilter(SearchFilters $scarchFilter)
    {
        $this->scarchFilter = $scarchFilter;

        return $this;
    }

    public function getSearchQuery()
    {
        return $this->scarchFilter->getPage();
    }

    public function getSort()
    {
        
    }

}
