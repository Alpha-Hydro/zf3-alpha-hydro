<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Model\Entity;


use Api\Model\TableGateway\AbstractEntityTableGateway;

class Category extends AbstractEntityTableGateway implements CategoryInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $parent_id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $image;

    /**
     * @var string
     */
    protected $description;
    /**
     * @var string
     */
    protected $full_path;

    /**
     * @var array
     */
    protected $products;

    /**
     * @var array
     */
    protected $subcategories;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getFullPath()
    {
        return $this->full_path;
    }

    /**
     * @param array $products
     * @return Category
     */
    public function setProducts($products)
    {
        $this->products = $products;
        return $this;
    }

    /**
     * @return array
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @return array
     */
    public function getSubcategories()
    {
        return $this->subcategories;
    }

    /**
     * @param array $subcategories
     * @return Category
     */
    public function setSubcategories($subcategories)
    {
        $this->subcategories = $subcategories;
        return $this;
    }

}