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
use Zend\Paginator\Adapter\DbSelect;

class Mapper extends AbstractReadMapper
{
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