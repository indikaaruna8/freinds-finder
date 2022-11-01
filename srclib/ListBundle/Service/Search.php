<?php

namespace Lib\In\ListBundle\Service;

use Lib\In\ListBundle\Interfaces\SearchRequesInterface as SREQI;
use Lib\In\ListBundle\Interfaces\QueryBuilderInterface as QBI;
use Lib\In\ListBundle\Interfaces\SearchRepositoryInterface as SRI;

/**
 * Description of Search
 *
 * @author indika
 */
class Search
{

    private $qbi;

    public function __construct(QBI $qbi)
    {
        $this->qbi = $qbi;
    }

    //put your code here    
    public function getData(SREQI $req, SRI $repository)
    {
        $this->qbi->setScarchFilter($req->getFilters());
        return [
            'meta' => [
                'ss' => $this->qbi->getSearchQuery(),
                'count' => $repository->seachCount($this->qbi)
            ],
            'records' => $repository->search($this->qbi)
        ];
    }

}
