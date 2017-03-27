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

class ProductTableFactory
{
      function __invoke(ContainerInterface $container)
      {
          $tableGateway = $container->get(ProductTableGateway::class);
          return new ProductTable($tableGateway);
      }
}