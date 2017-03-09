<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Catalog;


use Zend\Router\Http\Regex;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return[
    'service_manager' => [
        'aliases' => [
            Model\MapperInterface::class => Model\CategoriesMapper::class,
        ],
        'factories' => [
            Model\CategoriesMapper::class => Factory\CategoriesMapperFactory::class
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Factory\IndexControllerFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'catalog' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/catalog',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes'  => [
                    'fullPath' => [
                        'type' => Regex::class,
                        'options' => [
                            'regex' => '/(?<path>[\w\-\/]+)',
                            'defaults' => array(
                                'action'     => 'index',
                                'path' => '',
                            ),
                            'spec' => '/%path%',
                        ],
                    ],
                    'path' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/:path',
                            'defaults' => [
                                'action' => 'index',
                            ],
                            'constraints' => [
                                'path' => '[a-z]*',
                            ],
                        ],
                    ],
                    'list' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/:id',
                            'defaults' => [
                                'action' => 'index',
                            ],
                            'constraints' => [
                                'id' => '[1-9]\d*',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];