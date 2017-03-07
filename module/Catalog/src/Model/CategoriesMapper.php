<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Catalog\Model;


use InvalidArgumentException;
use RuntimeException;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Hydrator\HydratorInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Debug\Debug;

class CategoriesMapper implements MapperInterface
{
    private $db;

    private $hydrator;

    private $categoryPrototype;

    public function __construct(
        AdapterInterface $adapter,
        HydratorInterface $hydrator,
        Categories $categoriesPrototype
    )
    {
        $this->db = $adapter;
        $this->hydrator = $hydrator;
        $this->categoryPrototype = $categoriesPrototype;
    }

    public function fetch($id)
    {
        $sql       = new Sql($this->db);
        $select    = $sql->select('categories');
        $select->where(['id = ?' => $id]);

        $statement = $sql->prepareStatementForSqlObject($select);
        $result    = $statement->execute();

        if (!$result instanceof ResultInterface || ! $result->isQueryResult()) {
            throw new RuntimeException(sprintf(
                'Failed retrieving catalog category with identifier "%s"; unknown database error.',
                $id
            ));
        }

        $resultSet = new HydratingResultSet($this->hydrator, $this->categoryPrototype);
        $resultSet->initialize($result);
        $category = $resultSet->current();

        if (! $category) {
            throw new InvalidArgumentException(sprintf(
                'Catalog category with identifier "%s" not found.',
                $id
            ));
        }

        return $category;
    }

    public function fetchAll()
    {
        $sql    = new Sql($this->db);
        $select = $sql->select('categories');
        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if (! $result instanceof ResultInterface || ! $result->isQueryResult()) {
            return [];
        }

        $resultSet = new HydratingResultSet(
            $this->hydrator,
            $this->categoryPrototype
        );
        $resultSet->initialize($result);
        return $resultSet;
    }
}