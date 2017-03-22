<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Model\Product;

use Api\Model\ProductProperty\PropertyHydrator;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway as ZFTableGateway;
use Zend\Hydrator\Aggregate\AggregateHydrator;

class TableGateway extends ZFTableGateway
{
    public function __construct($table, AdapterInterface $adapter, $features = null)
    {

        $aggregateHydrator = new AggregateHydrator();

        $aggregateHydrator->add(new ProductHydrator());
        $aggregateHydrator->add(new PropertyHydrator());


        $resultSetPrototype = new HydratingResultSet($aggregateHydrator, new Entity());
        parent::__construct($table, $adapter, $features, $resultSetPrototype);
    }
}