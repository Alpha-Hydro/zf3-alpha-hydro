<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Model\Category;

use Api\Model\AbstractReadMapper;
use Api\Model\Collection;
use Zend\Paginator\Adapter\DbTableGateway;

class Mapper extends AbstractReadMapper
{

    /**
     * @param $parentId
     * @return Collection
     */
    public function fetchList($parentId)
    {
        return new Collection(
            new DbTableGateway(
                $this->tableGateway,
                [
                    'active != ?' => 0,
                    'deleted != ?' => 1,
                    'parent_id = ?' => $parentId
                ],
                ['sorting' => 'ASC']
            ));
    }

}