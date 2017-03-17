<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Model\ProductProperty;


use Api\Model\AbstractReadMapper;
use Api\Model\Collection;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;

class Mapper extends AbstractReadMapper
{
    /**
     * @param $product_id
     * @return Collection
     */
    public function fetchList($product_id)
    {
        $product_id = (int) $product_id;

        $sql    = $this->tableGateway->getSql();
        $select = $sql->select();
        $select
            ->where([
                'product_id' => $product_id,
            ])
            ->order('order ASC');

        $resultSetPrototype = $this->tableGateway->getResultSetPrototype();

       return new Collection(new DbSelect(
            $select,
            $sql,
            $resultSetPrototype
        ));

    }

    /**
     * @param $product_id
     * @return ResultSet
     */
    public function fetchByProductId($product_id)
    {
        $product_id = (int) $product_id;

        return $this->tableGateway->select(function (Select $select) use ($product_id){
            $select
                ->where([
                    'product_id' => $product_id
                ])
                ->order('order ASC');
        });
    }
}