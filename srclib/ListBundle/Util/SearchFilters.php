<?php


namespace Lib\In\ListBundle\Util;

/**
 * Description of SearchSetting
 *
 * @author indika
 */
class SearchFilters
{

    /**
     * 
     */
    const DEFAULT_PAGE_SIZE = 10;

    /**
     * 
     */
    const DEFAULT_PAGE = 1;

    /**
     * 
     * @var string
     */
    private $searchString = "";

    /**
     * 
     * @var int
     */
    private $pageSize = self::DEFAULT_PAGE_SIZE;

    /**
     * 
     * @var int
     */
    private $page = self::DEFAULT_PAGE;

    /**
     * 
     * @var array
     */
    private $columns = [];

    /**
     * 
     * @var array
     */
    private $orderBy = [];

    public function getSearchString(): string
    {
        return $this->searchString;
    }

    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getColumns(): array
    {
        return $this->columns;
    }

    public function getOrderBy(): array
    {
        return $this->orderBy;
    }

    public function setSearchString(string $searchString)
    {
        $this->searchString = $searchString;
        return $this;
    }

    public function setPageSize(int $pageSize)
    {
        $this->pageSize = $pageSize;
        return $this;
    }

    public function setPage(int $page)
    {
        $this->page = $page;

        return $this;
    }

    public function setColumns(array $columns)
    {
        $this->columns = $columns;

        return $this;
    }

    public function setOrderBy(array $orderBy)
    {
        $this->orderBy = $orderBy;

        return $this;
    }

}
