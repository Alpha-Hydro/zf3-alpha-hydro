<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Model\TableGateway;


use Interop\Container\ContainerInterface;

class ProductPropertyTableFactory
{
    function __invoke(ContainerInterface $container)
    {
        $tableGateway = $container->get(ProductPropertyTableGateway::class);
        return new ProductPropertyTable($tableGateway);
    }

}