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

class CategoryTable extends AbstractReadMapperTableGateway
{

    /**
     * @param $parentId
     * @param bool $isCollection
     * @return ResultSet|Collection
     */
    public function fetchList($parentId, $isCollection =  false)
    {

        $parentId = (int) $parentId;

        $resultSet = $this->tableGateway->select(function (Select $select) use ($parentId){
            $select
                ->where([
                    'active' => 1,
                    'deleted' => 0,
                    'parent_id' => $parentId
                ])
                ->order('sorting ASC');
        });

        if ($isCollection){
            return new Collection(new ArrayAdapter($resultSet->toArray()));
        }

        return $resultSet;
    }

}