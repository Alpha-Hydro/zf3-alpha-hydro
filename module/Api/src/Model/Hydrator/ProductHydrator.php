<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Model\Hydrator;

use Api\Model\Entity\Category;
use Api\Model\Entity\ProductInterface;
use Zend\Debug\Debug;
use Zend\Hydrator\Reflection as ReflectionHydrator;

class ProductHydrator extends ReflectionHydrator
{
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof ProductInterface)
            return $object;

        //Debug::dump($data); die();

        return parent::hydrate($data, $object);
    }

}