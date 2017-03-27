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

class CategoryTableFactory
{
    function __invoke(ContainerInterface $container)
    {
        $tableGateway = $container->get(CategoryTableGateway::class);
        return new CategoryTable($tableGateway);
    }
}