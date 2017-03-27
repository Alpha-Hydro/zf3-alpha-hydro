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
use Zend\Paginator\Adapter\ArrayAdapter;

class ProductPropertyTable extends AbstractReadMapperTableGateway
{
    /**
     * @param $productId
     * @param bool $isCollection
     * @return Collection|ResultSet
     */
    public function fetchList($productId, $isCollection =  false)
    {
        $productId = (int) $productId;

        $resultSet = $this->tableGateway->select(function (Select $select) use ($productId){
            $select
                ->where([
                    'product_id' => $productId,
                ])
                ->order('order ASC');
        });

        if ($isCollection){
            return new Collection(new ArrayAdapter($resultSet->toArray()));
        }

        return $resultSet;
    }

}