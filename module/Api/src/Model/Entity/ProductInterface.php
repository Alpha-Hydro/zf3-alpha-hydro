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
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getSku();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getImage();

    /**
     * @return string
     */
    public function getUploadPath();

    /**
     * @return string
     */
    public function getDraft();

    /**
     * @return string
     */
    public function getUploadPathDraft();

    /**
     * @return string
     */
    public function getNote();

    /**
     * @return string
     */
    public function getFullPath();

    /**
     * @return int
     */
    public function getCategoryId();

    /**
     * @return array
     */
    public function getCategory();

    /**
     * @return array
     */
    public function getProperties();

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