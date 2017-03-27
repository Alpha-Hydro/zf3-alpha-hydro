<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Model\TableGateway;


use Api\Model\Collection;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\ArrayAdapter;

class ProductTable extends AbstractReadMapperTableGateway
{
    /**
     * @param $categoryId
     * @param bool $isCollection
     * @return Collection|ResultSet
     */
    public function fetchList($categoryId, $isCollection =  false)
    {
        $categoryId = (int) $categoryId;

        $resultSet = $this->tableGateway->select(function (Select $select) use ($categoryId){
            $select
                ->join('categories_xref', 'products.id = categories_xref.product_id')
                ->where([
                    'category_id' => $categoryId,
                    'active' => 1,
                    'deleted' => 0,
                ])
                ->order('sorting ASC');
        });

        if ($isCollection){
            return new Collection(new ArrayAdapter($resultSet->toArray()));
        }

        return $resultSet;
    }

}