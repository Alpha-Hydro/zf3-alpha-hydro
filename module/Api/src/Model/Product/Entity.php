<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Model\Product;

use Api\Model\AbstractEntityTableGateway;

class Entity extends AbstractEntityTableGateway
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

    /**
     * @var string
     */
    public $image;

    /**
     * @var string
     */
    public $uploadPath;

    /**
     * @var string
     */
    public $draft;

    /**
     * @var string
     */
    public $uploadPathDraft;

    /**
     * @var string
     */
    public $note;

    /**
     * @var string
     */
    public $fullPath;
}