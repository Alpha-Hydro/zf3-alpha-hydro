<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Model;


use Zend\Db\ResultSet\HydratingResultSet;

interface ReadingMapperInterface
{
    /**
     * @param $id
     * @return array|\ArrayObject|null
     */
    public function fetch($id);

    /**
     * @param $parentId
     * @return Collection | HydratingResultSet
     */
    public function fetchList($parentId);

    /**
     * @return Collection | HydratingResultSet
     */
    public function fetchAll();

}