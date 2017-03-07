<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Catalog\Model;


use DomainException;

class CategoriesRepository implements MapperInterface
{
    private $data = [
        1 => [
            'id'    => 1,
            'parentId' => '0',
            'name' => 'category#1',
            'image'=> 'image_path',
            'description'=> 'This is our category #1!',
            'fullPath'=> '',
            'metaTitle'=> '',
            'metaDescription'=> '',
            'metaKeywords'=> '',
        ],
        2 => [
            'id'    => 2,
            'parentId' => '0',
            'name' => 'category#2',
            'image'=> 'image_path',
            'description'=> 'This is our category #2!',
            'fullPath'=> '',
            'metaTitle'=> '',
            'metaDescription'=> '',
            'metaKeywords'=> '',
        ]
    ];

    public function fetchAll()
    {
        return array_map(function ($category) {
            return new Categories(
                $category['parentId'],
                $category['name'],
                $category['image'],
                $category['description'],
                $category['fullPath'],
                $category['metaTitle'],
                $category['metaDescription'],
                $category['metaKeywords'],
                $category['id']
            );
        }, $this->data);
    }

    public function fetch($id)
    {
        if (! isset($this->data[$id])) {
            throw new DomainException(sprintf('Category by id "%s" not found', $id));
        }

        return new Categories(
            $this->data[$id]['parentId'],
            $this->data[$id]['name'],
            $this->data[$id]['image'],
            $this->data[$id]['description'],
            $this->data[$id]['fullPath'],
            $this->data[$id]['metaTitle'],
            $this->data[$id]['metaDescription'],
            $this->data[$id]['metaKeywords'],
            $this->data[$id]['id']
        );
    }
}