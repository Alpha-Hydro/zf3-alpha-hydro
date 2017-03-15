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

class RestController extends AbstractRestfulController
{

    public function getList()
    {
        return new JsonModel(['Hello' => 'List']);
    }

    public function get($id)
    {
        return new JsonModel(['id' => $id]);
    }
}