<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Factory;


use Api\Controller\ProductController;
use Api\Model\Mapper\ProductMapper;
use Api\Model\Mapper\ProductPropertyMapper as PropertyMapper;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ProductControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new ProductController(
            $container->get(ProductMapper::class),
            $container->get(PropertyMapper::class)
        );
    }
}