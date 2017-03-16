<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Model;


use DomainException;
use Zend\Db\TableGateway\TableGateway;
use Zend\Paginator\Adapter\DbTableGateway;

abstract class AbstractReadMapper implements ReadingMapperInterface
{
    /**
     * @var TableGateway
     */
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * @param $id
     * @return array|\ArrayObject|null
     */
    public function fetch($id)
    {
        $id = (int) $id;
        $resultSet = $this->tableGateway->select(['id' => $id]);

        if (0 === count($resultSet)) {
            throw new DomainException('Status message not found', 404);
        }
        return $resultSet->current();
    }

    public function fetchAll()
    {
        return new Collection(
            new DbTableGateway(
                $this->tableGateway,
                null,
                ['sorting' => 'ASC']
            ));
    }

}