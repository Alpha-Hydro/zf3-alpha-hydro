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
        return new ViewModel([
            'categories' => $this->categoriesRepository->fetchAll(),
        ]);
    }
}