<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Hydrator\ArraySerializable;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'service_manager' => [
        'factories' => [
            //Categories
            Model\TableGateway\CategoryTable::class => function($container) {
                $tableGateway = $container->get(Model\CategoryTableGateway::class);
                return new Model\TableGateway\CategoryTable($tableGateway);
            },
            Model\CategoryTableGateway::class => function ($container) {
                $dbAdapter = $container->get(AdapterInterface::class);
                $resultSetPrototype = new HydratingResultSet(new ArraySerializable(), new Model\Entity\Category());
                return new TableGateway('categories', $dbAdapter, null, $resultSetPrototype);
            },
            Model\Entity\Category::class => Model\Entity\CategoryFactory::class,
            Model\Mapper\CategoryMapper::class => Model\Mapper\CategoryMapperFactory::class,
            Model\Hydrator\CategoryHydrator::class => Model\Hydrator\CategoryHydratorFactory::class,
            //Products
            Model\TableGateway\ProductTable::class => function($container) {
                $tableGateway = $container->get(Model\ProductTableGateway::class);
                return new Model\TableGateway\ProductTable($tableGateway);
            },
            Model\ProductTableGateway::class => function($container){
                $dbAdapter = $container->get(AdapterInterface::class);
                $resultSetPrototype = new HydratingResultSet(new ArraySerializable(), new Model\Entity\Product());
                return new TableGateway('products', $dbAdapter, null, $resultSetPrototype);

            },
            Model\Entity\Product::class => Model\Entity\ProductFactory::class,
            Model\Mapper\ProductMapper::class => Model\Mapper\ProductMapperFactory::class,
            Model\Hydrator\ProductHydrator::class => Model\Hydrator\ProductHydratorFactory::class,
            //ProductProperty
            Model\TableGateway\ProductPropertyTable::class => function($container) {
                $tableGateway = $container->get(Model\ProductPropertyTableGateway::class);
                return new Model\TableGateway\ProductPropertyTable($tableGateway);
            },
            Model\ProductPropertyTableGateway::class => function($container){
                $dbAdapter = $container->get(AdapterInterface::class);
                $resultSetPrototype = new HydratingResultSet(new ArraySerializable(), new Model\Entity\ProductProperty());
                return new TableGateway('products_params', $dbAdapter, null, $resultSetPrototype);
            },
            Model\Entity\ProductProperty::class => Model\Entity\ProductPropertyFactory::class,
            Model\Hydrator\ProductPropertyHydrator::class => Model\Hydrator\ProductPropertyHydratorFactory::class,
            Model\Mapper\ProductPropertyMapper::class => Model\Mapper\ProductPropertyMapperFactory::class,
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\ApiController::class => Factory\ApiControllerFactory::class,
            Controller\RestController::class => InvokableFactory::class,
            Controller\CategoriesController::class => Factory\CategoriesControllerFactory::class,
            Controller\ProductController::class => Factory\ProductControllerFactory::class,
            Controller\DoctrineController::class=>Factory\DoctrineControllerFactory::class,
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
            'doctrine' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/doctrine[/:id]',
                    'constraints' => [
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\DoctrineController::class,
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
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Model/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Model\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ]
];