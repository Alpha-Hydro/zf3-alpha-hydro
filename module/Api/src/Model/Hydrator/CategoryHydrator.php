<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Model\Hydrator;

use Api\Model\Entity\CategoryInterface;
use Zend\Debug\Debug;
use Zend\Hydrator\Reflection as ReflectionHydrator;

class CategoryHydrator extends ReflectionHydrator
{
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof CategoryInterface)
            return $object;


        parent::hydrate($data, $object);

        return $object;
    }

}