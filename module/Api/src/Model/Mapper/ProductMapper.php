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
use Api\Model\Entity\Product;
use Api\Model\ReadingMapperInterface;
use InvalidArgumentException;
use RuntimeException;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Hydrator\HydratorInterface;
use Zend\Paginator\Adapter\ArrayAdapter;

class ProductMapper implements ReadingMapperInterface
{
    private $db;

    private $hydrator;

    private $entityPrototype;

    public function __construct(
        AdapterInterface $adapter,
        HydratorInterface $hydrator,
        Product $entityPrototype
    )
    {
        $this->db = $adapter;
        $this->hydrator = $hydrator;
        $this->entityPrototype = $entityPrototype;
    }

    public function fetch($id, $isArray = false)
    {
        $sql       = new Sql($this->db);
        $select    = $sql->select('products');
        $select
            ->join('categories_xref', 'products.id = categories_xref.product_id')
            ->where(['id = ?' => $id]);

        $statement = $sql->prepareStatementForSqlObject($select);
        $result    = $statement->execute();

        if (!$result instanceof ResultInterface || ! $result->isQueryResult()) {
            throw new RuntimeException(sprintf(
                'Failed retrieving product with identifier "%s"; unknown database error.',
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
                'Product with identifier "%s" not found.',
                $id
            ));
        }

        return $resultSetItem;
    }

    public function fetchList($parentId = null, $isCollection = false)
    {
        if (is_null($parentId))
            $parentId = 0;

        $sql    = new Sql($this->db);
        $select = $sql->select('products');
        $select
            ->join('categories_xref', 'products.id = categories_xref.product_id')
            ->where([
                'category_id' => $parentId,
                'active' => 1,
                'deleted' => 0,
            ])
            ->order('sorting ASC');

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
        $select = $sql->select('products');
        $select->join('categories_xref', 'products.id = categories_xref.product_id');

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