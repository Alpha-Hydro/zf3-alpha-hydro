<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Model\ProductProperty;


use Api\Model\AbstractEntityTableGateway;

class Entity extends AbstractEntityTableGateway
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     */
    public $productId;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $value;
}