<?php

namespace Lib\In\ListBundle\Service;

use Lib\In\ListBundle\Interfaces\SearchRequesInterface as SREQI;
use Lib\In\ListBundle\Interfaces\QueryBuilderInterface as QBI;
use Lib\In\ListBundle\Interfaces\SearchRepositoryInterface as SRI;
use \ReflectionClass;
use Lib\In\ListBundle\Util\JsonEntity;
use Symfony\Component\Routing\RouterInterface as RI;

/**
 * Description of Search
 *
 * @author indika
 */
class Search
{

    /**
     * 
     * @var QBI QueryBuilderInterface
     */
    private QBI $qbi;

    /**
     * 
     * @var RouterInterface
     */
    private RI $router;

    public function __construct(QBI $qbi, RI $ri)
    {
        $this->qbi = $qbi;
        $this->router = $ri;
    }

    //put your code here    
    public function getData(SREQI $req, SRI $repository, array $fields = [], array $paths = []): array
    {
        $this->qbi->setSearchfilter($req->getFilters())
                ->setFields($fields)
        ;
        $queryBuilder = $this->qbi->getQuery($repository);
        $records = [];
        $count = $repository->seachCount($queryBuilder);
        if ($count > 0) {
            $records = $this->getRecourds($repository->search($this->qbi->getSearchQuery()), $fields, $paths);
        }
        return [
            'meta' => [
                'count' => $count
            ],
            'records' => iterator_to_array($records)
        ];
    }

    protected function getRecourds($dataset, array $fields, array $paths)
    {
        foreach ($dataset as $object) {
            $jsonObject = $this->getJsonObject($object);
            $row = [];
            foreach ($fields as $key => $field) {
                $row[$key] = $this->getValue($jsonObject, $key, $field);
            }
            $row['routes'] = iterator_to_array($this->getRoutes($paths, $field, $jsonObject));

            yield $row;
        }
    }

    private function getRoutes($paths, $field, $jsonObject)
    {
        foreach ($paths as $action => $path) {
            $parameters = [];
            foreach ($path['param'] as $name => $methodName) {
                $parameters[$name] = $this->getValue($jsonObject, $methodName, []);
            }
            yield "__" . $action => $this->router->generate($path['route_name'], $parameters);
        }
    }

    private function getValue($jsonObject, $name, $field)
    {
        $method = $this->getMethodName($name);
        $args = [];
        if (isset($field['args'])) {
            $args = $field['args'];
        }

        return call_user_func_array([$jsonObject, $method], $args);
    }

    private function getMethodName($field)
    {
        return 'get' . str_replace(" ", "", ucwords(str_replace("_", " ", $field)));
    }

    private function getJsonObject($object): JsonEntity
    {
        $jsonClass = $this->getJsonClass($object);
        if (!class_exists($jsonClass)) {
            throw new Exception("Class not found");
        }
        $reflect = new \ReflectionClass($jsonClass);
        return $reflect->newInstanceArgs([$object]);
    }

    private function getJsonClass($object)
    {
        $reflect = new ReflectionClass($object);
        $namespace = $reflect->getName();
        $class = $reflect->getShortName();

        if ($object instanceof Proxy) {
            if ($parent = $reflect->getParentClass()) {
                $namespace = $parent->getName();
                $class = $parent->getShortName();
            }
        }

        $cname = str_replace("\\Entity\\", "\\Json\\", $namespace) . "Json";
       

        if (!class_exists($cname)) {
            throw new Exception( $cname .  " is not exist.") ;
        }

        return $cname;
    }

}
