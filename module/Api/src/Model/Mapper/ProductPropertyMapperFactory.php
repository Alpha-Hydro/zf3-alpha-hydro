<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Model\Mapper;


use Api\Model\Entity\ProductProperty;
use Api\Model\Hydrator\ProductPropertyHydrator;
use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ProductPropertyMapperFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new ProductPropertyMapper(
            $container->get(AdapterInterface::class),
            $container->get(ProductPropertyHydrator::class),
            $container->get(ProductProperty::class)
        );
    }
}