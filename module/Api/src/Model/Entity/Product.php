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

class Product extends AbstractEntityTableGateway implements ProductInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $sku;

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
    protected $upload_path;

    /**
     * @var string
     */
    protected $draft;

    /**
     * @var string
     */
    protected $upload_path_draft;

    /**
     * @var string
     */
    protected $note;

    /**
     * @var string
     */
    protected $full_path;

    /**
     * @var int
     */
    protected $category_id;


    /**
     * @var array
     */
    protected $category;
    /**
     * @var array
     */
    protected $properties;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
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
    public function getUploadPath()
    {
        return $this->upload_path;
    }

    /**
     * @return string
     */
    public function getDraft()
    {
        return $this->draft;
    }

    /**
     * @return string
     */
    public function getUploadPathDraft()
    {
        return $this->upload_path_draft;
    }

    /**
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @return string
     */
    public function getFullPath()
    {
        return $this->full_path;
    }

    /**
     * @return int
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * @return array
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return array
     */
    public function getProperties()
    {
        return $this->properties;
    }

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