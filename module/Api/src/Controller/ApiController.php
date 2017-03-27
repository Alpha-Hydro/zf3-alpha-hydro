<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Controller;


use Api\Model\TableGateway\CategoryTable;
use Api\Model\TableGateway\ProductTable;
use Zend\Debug\Debug;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class ApiController extends AbstractRestfulController
{
    private $categoryTable;

    private $productTable;

    public function __construct(CategoryTable $categoryTable, ProductTable $productTable)
    {
        $this->categoryTable = $categoryTable;
        $this->productTable = $productTable;
    }

    public function indexAction()
    {
        $id = (!is_null($this->params()->fromQuery("id")))
            ? $this->params()->fromQuery("id")
            : 0;

        if ($this->params()->fromQuery("collections")){
            $collections = $this->productTable->fetchList($id, true);
            return new JsonModel([
                'pages' => $collections->count(),
                'total_item_count' => $collections->getTotalItemCount(),
                'current_page' => $collections->getCurrentPageNumber(),
                'item_count_per_page' => $collections->getItemCountPerPage(),
                'items' => $collections->getCurrentItems(),
            ]);
        }

        return new JsonModel($this->productTable->fetchList($id));
    }
}