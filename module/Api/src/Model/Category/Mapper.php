<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Api\Model\Category;

use DomainException;
use Zend\Paginator\Adapter\DbTableGateway;

class Mapper implements MapperInterface
{

    /**
     * @var TableGateway
     */
    private $table;

    public function __construct(TableGateway $tableGateway)
    {
        $this->table = $tableGateway;
    }

    /**
     * @param $id
     * @return array|\ArrayObject|null
     */
    public function fetch($id)
    {
        $resultSet = $this->table->select(['id' => $id]);

        if (0 === count($resultSet)) {
            throw new DomainException('Status message not found', 404);
        }
        return $resultSet->current();
    }

    /**
     * @param $parentId
     * @return Collection
     */
    public function fetchList($parentId)
    {
        return new Collection(
            new DbTableGateway(
                $this->table,
                [
                    'active != ?' => 0,
                    'deleted != ?' => 1,
                    'parent_id = ?' => $parentId
                ],
                ['sorting' => 'ASC']
            ));
    }

    /**
     * @return Collection
     */
    public function fetchAll()
    {
        return new Collection(new DbTableGateway($this->table, null, ['sorting' => 'ASC']));
    }
}