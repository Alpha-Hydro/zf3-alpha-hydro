<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 *  Equivalently Entity
 *
 */

namespace Api\Model\Product;


class Product
{
    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $sku;
    /**
     * @var string
     */
    public $name;

    public function exchangeArray(array $data)
    {
        $this->id     = !empty($data['id']) ? $data['id'] : null;
        $this->sku = !empty($data['sku']) ? $data['sku'] : null;
        $this->name  = !empty($data['name']) ? $data['name'] : null;
    }
}