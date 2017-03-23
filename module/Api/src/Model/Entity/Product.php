<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Model\Entity;


class Product implements ProductInterface
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
    public $upload_path;

    /**
     * @var string
     */
    public $draft;

    /**
     * @var string
     */
    public $upload_path_draft;

    /**
     * @var string
     */
    public $note;

    /**
     * @var string
     */
    public $full_path;

    /**
     * @var int
     */
    public $category_id;


    /**
     * @var array
     */
    public $category;
    /**
     * @var array
     */
    public $properties;

    /**
     * @param array $properties
     * @return Product
     */
    public function setProperties($properties)
    {
        $this->properties = $properties;
        return $this;
    }

    /**
     * @param array $category
     * @return Product
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }


}