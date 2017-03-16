<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Controller;


use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class ApiController extends AbstractRestfulController
{
    public function indexAction()
    {
        $entity = preg_replace(
            " /(?=[A-Z])/",
            "$1_$2",
            "uploadPath"
        );

        return new JsonModel(['Hello' => strtolower($entity)]);
    }
}