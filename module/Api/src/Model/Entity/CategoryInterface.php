<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Model\Entity;


interface CategoryInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return int
     */
    public function getParentId();

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
    public function getDescription();

    /**
     * @return string
     */
    public function getFullPath();


    /**
     * @param array $products
     * @return Category
     */
    public function setProducts($products);

    /**
     * @param array $subcategories
     * @return Category
     */
    public function setSubcategories($subcategories);

}