<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'service_manager' => [
        'factories' => [
            //Categories
            //Model\Category\Mapper::class => Model\Category\MapperFactory::class,
            //Model\Category\TableGateway::class => Model\Category\TableGatewayFactory::class,
            Model\Entity\Category::class => Model\Entity\CategoryFactory::class,
            Model\Mapper\CategoryMapper::class => Model\Mapper\CategoryMapperFactory::class,
            Model\Hydrator\CategoryHydrator::class => Model\Hydrator\CategoryHydratorFactory::class,
            //Products
            //Model\Product\Mapper::class => Model\Product\MapperFactory::class,
            //Model\Product\TableGateway::class => Model\Product\TableGatewayFactory::class,
            Model\Entity\Product::class => Model\Entity\ProductFactory::class,
            Model\Mapper\ProductMapper::class => Model\Mapper\ProductMapperFactory::class,
            Model\Hydrator\ProductHydrator::class => Model\Hydrator\ProductHydratorFactory::class,
            //ProductProperty
            Model\Entity\ProductProperty::class => Model\Entity\ProductPropertyFactory::class,
            Model\Hydrator\ProductPropertyHydrator::class => Model\Hydrator\ProductPropertyHydratorFactory::class,
            Model\Mapper\ProductPropertyMapper::class => Model\Mapper\ProductPropertyMapperFactory::class,
            //Model\ProductProperty\TableGateway::class => Model\ProductProperty\TableGatewayFactory::class,
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\ApiController::class => InvokableFactory::class,
            Controller\RestController::class => InvokableFactory::class,
            Controller\CategoriesController::class => Factory\CategoriesControllerFactory::class,
            Controller\ProductController::class => Factory\ProductControllerFactory::class,
        ],
    ],
    // The following section is new and should be added to your file:
    'router' => [
        'routes' => [
            'api' => [
                'type'    => Literal::class,
                'options' => [
                    'route' => '/api',
                    'defaults' => [
                        'controller' => Controller\ApiController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes'  => [
                    'categories' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/categories[/:action[/:id]]',
                            'defaults' => [
                                'controller' => Controller\CategoriesController::class,
                                'action' => 'index',
                            ],
                            'constraints' => [
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'     => '[0-9]+',
                            ],
                        ],
                    ],
                    'products' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/products[/:action[/:id]]',
                            'defaults' => [
                                'controller' => Controller\ProductController::class,
                                'action' => 'index',
                            ],
                            'constraints' => [
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'     => '[0-9]+',
                            ],
                        ],
                    ],
                ],
            ],
            'rest' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/rest[/:id]',
                    'constraints' => [
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\RestController::class,
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy',
        ],
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
    ],
];