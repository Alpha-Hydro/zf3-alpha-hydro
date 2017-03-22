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
use Api\Model\Entity\Category;
use Api\Model\ReadingMapperInterface;
use InvalidArgumentException;
use RuntimeException;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Hydrator\HydratorInterface;
use Zend\Paginator\Adapter\DbSelect;

class CategoryMapper implements ReadingMapperInterface
{
    private $db;

    private $hydrator;

    private $entityPrototype;

    public function __construct(
        Adapter $adapter,
        HydratorInterface $hydrator,
        Category $categoriesPrototype
    )
    {
        $this->db = $adapter;
        $this->hydrator = $hydrator;
        $this->entityPrototype = $categoriesPrototype;
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

        $resultSet = new HydratingResultSet($this->hydrator, $this->entityPrototype);
        $resultSet->initialize($result);
        $category = $resultSet->current();


        if (!$category) {
            throw new InvalidArgumentException(sprintf(
                'Catalog category with identifier "%s" not found.',
                $id
            ));
        }

        return (array)$category;
    }

    /**
     * @param null $parentId
     * @return Collection
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

        /*$stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if (! $result instanceof ResultInterface || ! $result->isQueryResult()) {
            return [];
        }*/

        $resultSet = new HydratingResultSet(
            $this->hydrator,
            $this->entityPrototype
        );


        //$resultSet->initialize($result);

        $adapter = new DbSelect($select, $this->db, $resultSet);


        return new Collection($adapter);
    }

    /**
     * @return Collection
     */
    public function fetchAll()
    {
        $sql    = new Sql($this->db);
        $select = $sql->select('categories');

        /*$stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if (! $result instanceof ResultInterface || ! $result->isQueryResult()) {
            return [];
        }*/

        $resultSet = new HydratingResultSet(
            $this->hydrator,
            $this->entityPrototype
        );

        //$resultSet->initialize($result);

        $adapter = new DbSelect($select, $this->db, $resultSet);

        return  new Collection($adapter);
    }
}