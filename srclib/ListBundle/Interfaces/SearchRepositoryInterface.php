<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPInterface.php to edit this template
 */

namespace Lib\In\ListBundle\Interfaces;

use Doctrine\ORM\QueryBuilder;

/**
 *
 * @author indika
 */
interface SearchRepositoryInterface
{
//    public function setSeachQueryBuilder(QueryBuilderInterface $searchQueyrBuilder);

    public function seachCount(QueryBuilder $filter);

    public function search(QueryBuilder $filter);
}
