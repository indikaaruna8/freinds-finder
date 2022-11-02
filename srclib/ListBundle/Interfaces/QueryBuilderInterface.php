<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPInterface.php to edit this template
 */

namespace Lib\In\ListBundle\Interfaces;

use Lib\In\ListBundle\Util\SearchFilters;
use Doctrine\ORM\QueryBuilder;
use Lib\In\ListBundle\Interfaces\SearchRepositoryInterface;

/**
 *
 * @author indika
 */
interface QueryBuilderInterface
{
    public function setFields(array $fields) : self;
    
    public function getSearchQuery() : QueryBuilder;

    public function setSearchfilter(SearchFilters $searchFilter) : self;

    public function getQuery(SearchRepositoryInterface $sri): QueryBuilder;
}
