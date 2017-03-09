<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Catalog\Model;

use Zend\Db\ResultSet\HydratingResultSet;

interface MapperInterface
{
    /**
     * @param $id
     * @return HydratingResultSet
     */
    public function fetch($id);

    /**
     * @param null $parentId
     * @return HydratingResultSet
     */
    public function fetchList($parentId = null);

    /**
     * @param $fullPath
     * @return CategoryEntity
     */
    public function fetchByPath($fullPath);

    /**
     * @return mixed
     */
    public function fetchAll();
}