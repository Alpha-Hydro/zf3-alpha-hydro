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
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Hydrator\HydratorInterface;
use Zend\Paginator\Adapter\DbSelect;

class ProductMapper implements ReadingMapperInterface
{
    private $db;

    private $hydrator;

    private $entityPrototype;

    public function __construct(
        Adapter $adapter,
        HydratorInterface $hydrator,
        Product $entityPrototype
    )
    {
        $this->db = $adapter;
        $this->hydrator = $hydrator;
        $this->entityPrototype = $entityPrototype;
    }

    public function fetch($id)
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
                'Failed retrieving catalog category with identifier "%s"; unknown database error.',
                $id
            ));
        }

        $resultSet = new HydratingResultSet($this->hydrator, $this->entityPrototype);
        $resultSet->initialize($result);
        $resultSetItem = $resultSet->current();


        if (!$resultSetItem) {
            throw new InvalidArgumentException(sprintf(
                'Catalog category with identifier "%s" not found.',
                $id
            ));
        }

        return (array)$resultSetItem;
    }

    public function fetchList($parentId = null)
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

        return $resultSet;
    }

    public function fetchAll()
    {
        $sql    = new Sql($this->db);
        $select = $sql->select('products');
        $select->join('categories_xref', 'products.id = categories_xref.product_id');

        $resultSet = new HydratingResultSet(
            $this->hydrator,
            $this->entityPrototype
        );

        $adapter = new DbSelect($select, $this->db, $resultSet);

        return  new Collection($adapter);
    }


}