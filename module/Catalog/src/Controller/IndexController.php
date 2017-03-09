<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Catalog\Controller;


use Catalog\Model\MapperInterface;
use Zend\Debug\Debug;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    private $categoriesRepository;

    public function __construct(MapperInterface $repository)
    {
        $this->categoriesRepository = $repository;
    }

    public function indexAction()
    {

        $path = $this->params()->fromRoute('path');

        try{
            $categories = $this->categoriesRepository->fetchList(
                $this->categoriesRepository->fetchByPath($path)->getId()
            );
        }
        catch (\InvalidArgumentException $exception){
            $categories = $this->categoriesRepository->fetchList();
        }


        return new ViewModel([
            'categories' => $categories,
        ]);
    }
}