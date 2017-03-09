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
        CategoryEntity $categoriesPrototype
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

    /**
     * @param $fullPath
     * @return object
     */
    public function fetchByPath($fullPath)
    {
        $sql    = new Sql($this->db);
        $select = $sql->select('categories');
        $select->where([
            'full_path = ?' => $fullPath,
            'active' => 1,
            'deleted' => 0,
        ]);


        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if (!$result instanceof ResultInterface || ! $result->isQueryResult()) {
            throw new RuntimeException(sprintf(
                'Failed retrieving catalog category with path "%s"; unknown database error.',
                $fullPath
            ));
        }

        $resultSet = new HydratingResultSet($this->hydrator, $this->categoryPrototype);
        $resultSet->initialize($result);
        $category = $resultSet->current();

        if (! $category) {
            throw new InvalidArgumentException(sprintf(
                'Catalog category with path "%s" not found.',
                $fullPath
            ));
        }

        return $category;
    }


    /**
     * @param null $parentId
     * @return array|HydratingResultSet
     */
    public function fetchList($parentId = null)
    {
        if (is_null($parentId))
            $parentId = 0;

        $sql    = new Sql($this->db);
        $select = $sql->select('categories');
        $select->where([
            'parent_id = ?' => $parentId,
            'active' => 1,
            'deleted' => 0,
        ]);
        $select->order('sorting ASC');

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