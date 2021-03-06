<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Controller;


//use Api\Model\Category\CategoryTable;
//use Api\Model\Category\TableGateway;
use Api\Model\Mapper\CategoryMapper;
use Zend\Debug\Debug;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class CategoriesController extends AbstractRestfulController
{
    private $mapper;

    //private $tableGateway;

    public function __construct(CategoryMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function indexAction()
    {
        $page_number = $this->params()->fromQuery('page');

        $collections = $this->mapper->fetchAll(true);

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

        return new JsonModel($this->mapper->fetchList($id));
    }

    public function getAction()
    {
        $id = (!is_null($this->params()->fromRoute('id')))
            ? $this->params()->fromRoute('id')
            : 0;

        return new JsonModel($this->mapper->fetch($id, true));
    }

}