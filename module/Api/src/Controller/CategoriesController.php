<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Controller;


use Api\Model\Category\MapperInterface;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class CategoriesController extends AbstractRestfulController
{
    private $categories;

    public function __construct(MapperInterface $categoriesMapper)
    {
        $this->categories = $categoriesMapper;
    }

    public function indexAction()
    {
        $page_number = $this->params()->fromQuery('page');

        $collections = $this->categories->fetchAll();

        if (!is_null($page_number))
            $page_number = (int)$page_number;
        $collections->setCurrentPageNumber($page_number);


        return new JsonModel([
            'pages' => $collections->count(),
            'total_item_count' => $collections->getTotalItemCount(),
            'current_page' => $collections->getCurrentPageNumber(),
            'item_count_per_page' => $collections->getItemCountPerPage(),
            'items' => $collections->getCurrentItems(),
        ]);
    }

    public function listAction()
    {
        $id = (!is_null($this->params()->fromRoute('id')))
            ? $this->params()->fromRoute('id')
            : 0;

        $page_number = $this->params()->fromQuery('page');

        $collections = $this->categories->fetchList($id);

        if (!is_null($page_number))
            $page_number = (int)$page_number;
        $collections->setCurrentPageNumber($page_number);


        return new JsonModel([
            'pages' => $collections->count(),
            'total_item_count' => $collections->getTotalItemCount(),
            'current_page' => $collections->getCurrentPageNumber(),
            'item_count_per_page' => $collections->getItemCountPerPage(),
            'items' => $collections->getCurrentItems(),
        ]);
    }

}