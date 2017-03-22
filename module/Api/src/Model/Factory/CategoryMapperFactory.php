<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Model\Factory;

use Api\Model\Entity\Category;
use Api\Model\Hydrator\CategoryHydrator;
use Api\Model\Mapper\CategoryMapper;
use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class CategoryMapperFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new CategoryMapper(
            $container->get(AdapterInterface::class),
            new CategoryHydrator(),
            new Category()
        );
    }

}