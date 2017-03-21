<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Model\Product;


use Api\Model\ProductProperty\TableGateway;
use Zend\Hydrator\ArraySerializable;
use Zend\Hydrator\HydratorInterface;

class ProductPropertyHydrator implements HydratorInterface
{
    protected $propertyMapper;

    public function __construct(\Api\Model\ProductProperty\Mapper $mapper)
    {
        $this->propertyMapper = $mapper;
    }

    public function hydrate(array $data, $object)
    {
        if (!$object instanceof Entity){
            return $object;
        }
        if (array_key_exists('id', $data)) {
            $object->properties = $this->propertyMapper->fetchByProductId($data['id']);
        }

        return $object;

    }

    public function extract($object){

    }

}