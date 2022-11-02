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
    private ?string $searchString = "dd";

    /**
     * 
     * @var int
     */
    private int $pageSize = self::DEFAULT_PAGE_SIZE;

    /**
     * 
     * @var int
     */
    private int $page = self::DEFAULT_PAGE;

    /**
     * 
     * @var int|null
     */
    private ?int $pageStart = 0;

    /**
     * 
     * @var array
     */
    private array $columns = [];

    /**
     * 
     * @var array
     */
    private array $orderBy = [];

    public function getSearchString(): string
    {
        return $this->searchString;
    }

    public function setSearchString(string $searchString)
    {
        $this->searchString = $searchString;
        return $this;
    }

    public function getPageStart(): ?int
    {
        return $this->pageStart;
    }

    public function setPageStart(?int $pageStart)
    {
        $this->pageStart = $pageStart;

        return $this;
    }

    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    public function setPageSize(int $pageSize)
    {
        $this->pageSize = $pageSize;
        return $this;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function setPage(int $page)
    {
        $this->page = $page;

        return $this;
    }

    public function getColumns(): array
    {
        return $this->columns;
    }

    public function setColumns(array $columns)
    {
        $this->columns = $columns;

        return $this;
    }

    public function getOrderBy(): array
    {
        return $this->orderBy;
    }

    public function setOrderBy(array $orderBy)
    {
        $this->orderBy = $orderBy;

        return $this;
    }

}
