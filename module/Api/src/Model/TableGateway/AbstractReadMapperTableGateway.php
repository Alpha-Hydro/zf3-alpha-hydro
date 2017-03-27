<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Model\TableGateway;


use Api\Model\Collection;
use Api\Model\ReadingMapperInterface;
use DomainException;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Zend\Paginator\Adapter\ArrayAdapter;

abstract class AbstractReadMapperTableGateway implements ReadingMapperInterface
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
        $resultSet = $this->tableGateway->select(function (Select $select) use ($id){
            $select
                ->where([
                    'active' => 1,
                    'deleted' => 0,
                    'id' => $id
                ]);
        });

        if (0 === count($resultSet)) {
            throw new DomainException('Status message not found', 404);
        }

        return $resultSet->current()->getArrayCopy();
    }

    /**
     * @param bool $isCollection
     * @return ResultSet|Collection
     */
    public function fetchAll($isCollection =  false)
    {
        $resultSet = $this->tableGateway->select(function (Select $select){
            $select->where(['active' => 1, 'deleted' => 0]);
            $select->order('sorting ASC');
        });
        if ($isCollection){
           return new Collection(new ArrayAdapter($resultSet->toArray()));
        }

        return $resultSet;

    }

}