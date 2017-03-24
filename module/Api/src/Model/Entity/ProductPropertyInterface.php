<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Model\Entity;


interface ProductPropertyInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return int
     */
    public function getProductId();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getValue();
}