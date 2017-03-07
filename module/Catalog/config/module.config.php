<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Catalog;


use Zend\Router\Http\Literal;
use Zend\ServiceManager\Factory\InvokableFactory;

return[
    'service_manager' => [
        'aliases' => [
            Model\MapperInterface::class => Model\CategoriesMapper::class,
        ],
        'factories' => [
            //Model\CategoriesRepository::class => InvokableFactory::class,
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
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];