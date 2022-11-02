<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Lib\In\ListBundle\Service;

use Lib\In\ListBundle\Interfaces\QueryBuilderInterface;
use Lib\In\ListBundle\Util\SearchFilters;
use Doctrine\ORM\QueryBuilder as DoctrineQueryBuilder;
use Lib\In\ListBundle\Interfaces\SearchRepositoryInterface as SRI;

/**
 * Description of QueryBuilder
 *
 * @author indika
 */
class QueryBuilder implements QueryBuilderInterface
{

    /**
     * 
     * @var SearchFilters
     */
    private SearchFilters $scarchFilter;

    /**
     * 
     * @var array
     */
    private array $fields = [];

    /**
     * 
     * @var array
     */
    private $parameters = [];

    /**
     * 
     * @var DoctrineQueryBuilder
     */
    private $query;

    public function setSearchfilter(SearchFilters $scarchFilter): self
    {
        $this->scarchFilter = $scarchFilter;

        return $this;
    }

    public function setFields(array $fields): self
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * 
     * @return DoctrineQueryBuilder
     */
    public function getSearchQuery(): DoctrineQueryBuilder
    {
        $filter = $this->scarchFilter;
        return $this->query
            ->addOrderBy('a.name', 'DESC')
            ->setFirstResult($filter->getPageStart())
            ->setMaxResults($filter->getPageSize())
            ->setMaxResults($this->scarchFilter->getPageSize());
    }

    public function getQuery(SRI $sri): DoctrineQueryBuilder
    {
        $subQ = $this->getFilterQuery();
        $this->query = $sri->getSearchQuery();
        if (!empty($subQ)) {
            $this->query->where($subQ)
                ->setParameters($this->parameters);
        }

        return $this->query;
    }

    protected function getFilterQuery() : string
    {
        $searchValue = $this->scarchFilter->getSearchString();
        if (empty($searchValue)) {
            return '';
        }
        $seachField = $this->getSearchField();

        $str = trim($searchValue);
        $strParts = explode(' ', $str);
        $strParts = $strParts ?? [$str];
        $query = [];
        foreach ($seachField as $field) {
            $key = str_replace('.', '_', strtolower($field['field']));
            $querySub = [];
            foreach ($strParts as $i => $v) {
                $holder = $key . $i;
                $this->parameters[$holder] = '%' . $v . '%';
                $querySub[] = $field['field'] . ' LIKE :' . $holder;
            }

            $query [] = implode(' AND ', $querySub);
        }

        return '(' . implode(') OR (', $query) . ')';
    }

    private function getSearchField() : array 
    {
        return array_filter($this->fields, function ($field) {
            return isset($field['search']) && $field['search'] === true;
        });
    }

}
