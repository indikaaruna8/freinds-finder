<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPInterface.php to edit this template
 */

namespace Lib\In\ListBundle\Interfaces;

/**
 *
 * @author indika
 */
interface SearchRepositoryInterface
{

    public function seachCount(QueryBuilderInterface $filter);

    public function search(QueryBuilderInterface $filter);
}
