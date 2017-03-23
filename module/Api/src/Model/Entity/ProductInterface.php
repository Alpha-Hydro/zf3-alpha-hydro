<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Model\Entity;


interface ProductInterface
{
    /**
     * @param array $properties
     * @return Product
     */
    public function setProperties($properties);

    /**
     * @param array $category
     * @return Product
     */
    public function setCategory($category);

}