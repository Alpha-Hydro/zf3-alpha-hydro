<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Controller;

use Doctrine\ORM\EntityManager;
use Api\Model\Entity\Category;
use Doctrine\ORM\Query;
use Zend\Debug\Debug;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class DoctrineController extends AbstractRestfulController
{
    private $entityManager;

    /**
     * DoctrineController constructor.
     * @param $entityManager
     * @var \Doctrine\ORM\EntityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getList()
    {

        $categories = $this->entityManager
            ->getRepository(Category::class)
            ->findBy(['parent_id' => 0]);

        $items = [];
        foreach ($categories as $key => $category){
            $items[$category->getId()] = $category->getName();
        }

        return new JsonModel([
            $items,
        ]);
    }

}