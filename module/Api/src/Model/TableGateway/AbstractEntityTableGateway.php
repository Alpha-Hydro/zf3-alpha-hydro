<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Model\TableGateway;


abstract class AbstractEntityTableGateway implements EntityTableGatewayInteface
{
    public function exchangeArray(array $data){
        $class = new \ReflectionClass($this);
        $properties = $class->getProperties();

        foreach ($properties as $property){
            if ($property->isProtected())
                $property->setAccessible(true);

            $propertyName = $property->getName();
            $name = preg_replace("/(?=[A-Z])/", "$1_$2", $propertyName);
            strtolower($name);
            $this->$propertyName = !empty($data[$propertyName]) ? $data[$propertyName] : null;
        }
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}