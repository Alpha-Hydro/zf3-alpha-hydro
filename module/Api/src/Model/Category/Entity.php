<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Model\Category;


class Entity
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     */
    public $parent_id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $full_path;


    public function exchangeArray(array $data)
    {
        $this->id = !empty($data['id']) ? $data['id'] : null;
        $this->parent_id = !empty($data['parent_id']) ? $data['parent_id'] : null;
        $this->name = !empty($data['name']) ? $data['name'] : null;
        $this->full_path = !empty($data['full_path']) ? $data['full_path'] : null;
    }
}