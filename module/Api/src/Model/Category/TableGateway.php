<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Model\Category;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway as ZFTableGateway;
use Zend\Hydrator\ArraySerializable;

class TableGateway extends ZFTableGateway
{
    public function __construct($table, AdapterInterface $adapter, $features = null)
    {
        $resultSetPrototype = new HydratingResultSet(new ArraySerializable(), new Entity());
        parent::__construct($table, $adapter, $features, $resultSetPrototype);
    }
}