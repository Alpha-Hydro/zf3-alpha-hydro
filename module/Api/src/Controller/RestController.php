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

    /**
     * GET method
     * free query string
     * @return JsonModel
     */
    public function getList()
    {
        return new JsonModel(['Hello' => 'List']);
    }

    /**
     * GET method
     * $id route match query param
     * @param mixed $id
     * @return JsonModel
     */
    public function get($id)
    {
        return new JsonModel(['get' => $id]);
    }

    /**
     * POST method
     * $data in body content
     * Content-type application/json
     * @param mixed $data
     * @return JsonModel
     */
    public function create($data)
    {
        return new JsonModel(['create' => $data]);
    }

    /**
     * PUT method
     * $id route match query param
     * $data in body content
     * Content-type application/json
     * @param mixed $id
     * @param mixed $data
     * @return JsonModel
     */
    public function update($id, $data)
    {
        return new JsonModel([
            'update' => $id,
            'new data' => $data
        ]);
    }

    /**
     * DELETE method
     * $id route match query param
     * @param mixed $id
     * @return JsonModel
     */
    public function delete($id)
    {
        return new JsonModel(['delete' => $id]);
    }
}