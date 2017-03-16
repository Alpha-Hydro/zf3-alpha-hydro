<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Model\Product;


use Api\Model\AbstractReadMapper;
use Api\Model\Collection;
use Api\Model\ReadingMapperInterface;
use DomainException;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Adapter\DbTableGateway;

class Mapper extends AbstractReadMapper
{
    /**
     * @param $id
     * @return array|\ArrayObject|null
     */
    /*public function fetch($id)
    {
        $id = (int) $id;
        $resultSet = $this->tableGateway->select(['id' => $id]);

        if (0 === count($resultSet)) {
            throw new DomainException('Status message not found', 404);
        }
        return $resultSet->current();
    }*/

    /**
     * @param $category_id
     * @return Collection
     */
    public function fetchList($category_id)
    {
        $category_id = (int) $category_id;

        $sql    = $this->tableGateway->getSql();
        $select = $sql->select();
        $select
            ->join('categories_xref', 'products.id = categories_xref.product_id')
            ->where([
                'category_id' => $category_id,
                'active' => 1,
                'deleted' => 0
            ])
            ->order('sorting ASC');

        $resultSetPrototype = $this->tableGateway->getResultSetPrototype();

        return new Collection(new DbSelect(
            $select,
            $sql,
            $resultSetPrototype
        ));
    }

}