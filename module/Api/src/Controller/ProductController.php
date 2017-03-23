<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Controller;


use Api\Model\Mapper\ProductMapper;
use Api\Model\ProductProperty\Mapper as PropertyMapper;
use Zend\Debug\Debug;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

class ProductController extends AbstractActionController
{
    private $mapper;
    private $propertyMapper;

    public function __construct(ProductMapper $mapper, PropertyMapper $propertyMapper)
    {
        $this->mapper = $mapper;
        $this->propertyMapper = $propertyMapper;
    }

    public function indexAction()
    {
        $page_number = $this->params()->fromQuery('page');

        $collections = $this->mapper->fetchAll();

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

        return new JsonModel((array)$this->mapper->fetch($id));
    }

    public function propertyAction()
    {
        $id = $this->params()->fromRoute('id');

        if (is_null($id)){
            throw new \DomainException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        $collection = $this->propertyMapper->fetchList($id);
        $collection->setItemCountPerPage();

        return new JsonModel($collection->getIterator());
    }
}