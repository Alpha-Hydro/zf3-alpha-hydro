<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Model\Mapper;


use Api\Model\Collection;
use Api\Model\Entity\ProductProperty;
use Api\Model\ReadingMapperInterface;
use InvalidArgumentException;
use RuntimeException;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Hydrator\HydratorInterface;
use Zend\Paginator\Adapter\ArrayAdapter;

class ProductPropertyMapper implements ReadingMapperInterface
{
    private $db;

    private $hydrator;

    private $entityPrototype;

    public function __construct(
        AdapterInterface $adapter,
        HydratorInterface $hydrator,
        ProductProperty $entityPrototype
    )
    {
        $this->db = $adapter;
        $this->hydrator = $hydrator;
        $this->entityPrototype = $entityPrototype;
    }

    public function fetch($id, $isArray = false)
    {
        $sql       = new Sql($this->db);
        $select    = $sql->select('product_params');
        $select
            ->where(['id = ?' => $id]);

        $statement = $sql->prepareStatementForSqlObject($select);
        $result    = $statement->execute();

        if (!$result instanceof ResultInterface || ! $result->isQueryResult()) {
            throw new RuntimeException(sprintf(
                'Failed retrieving product property with identifier "%s"; unknown database error.',
                $id
            ));
        }

        $resultSet = new HydratingResultSet($this->hydrator, $this->entityPrototype);
        $resultSet->initialize($result);

        if($isArray)
            return array_shift($resultSet->toArray());

        $resultSetItem = $resultSet->current();

        if (!$resultSetItem) {
            throw new InvalidArgumentException(sprintf(
                'Product property with identifier "%s" not found.',
                $id
            ));
        }

        return $resultSetItem;
    }

    public function fetchList($product_id, $isCollection = false)
    {
        $sql    = new Sql($this->db);
        $select = $sql->select('product_params');
        $select
            ->where(['product_id' => $product_id])
            ->order('order ASC');

        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if (! $result instanceof ResultInterface || ! $result->isQueryResult()) {
            return [];
        }

        $resultSet = new HydratingResultSet(
            $this->hydrator,
            $this->entityPrototype
        );

        $resultSet->initialize($result);

        if ($isCollection)
            return new Collection(new ArrayAdapter($resultSet->toArray()));

        return $resultSet;
    }

    public function fetchAll($isCollection = false)
    {
        $sql    = new Sql($this->db);
        $select = $sql->select('product_params');

        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if (! $result instanceof ResultInterface || ! $result->isQueryResult()) {
            return [];
        }

        $resultSet = new HydratingResultSet(
            $this->hydrator,
            $this->entityPrototype
        );

        $resultSet->initialize($result);

        if ($isCollection)
            return new Collection(new ArrayAdapter($resultSet->toArray()));

        return $resultSet;
    }


}