<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Model\Entity;

use Doctrine\ORM\Mapping as ORM;
use Api\Model\TableGateway\AbstractEntityTableGateway;

/**
 * @ORM\Entity
 * @ORM\Table(name="categories")
 */

class Category extends AbstractEntityTableGateway implements CategoryInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     *
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(name="parent_id")
     * @var int
     */
    protected $parent_id;

    /**
     * @ORM\Column(name="name")
     * @var string
     */
    protected $name;

    /**
     * @ORM\Column(name="image")
     * @var string
     */
    protected $image;

    /**
     * @ORM\Column(name="description")
     * @var string
     */
    protected $description;

    /**
     * @ORM\Column(name="full_path")
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