<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Factory;


use Api\Controller\ApiController;
use Api\Model\TableGateway\CategoryTable;
use Api\Model\TableGateway\ProductTable;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ApiControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new ApiController(
            $container->get(CategoryTable::class),
            $container->get(ProductTable::class)
        );
    }
}