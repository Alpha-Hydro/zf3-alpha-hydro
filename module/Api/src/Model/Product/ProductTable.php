<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 * Equivalently Mapper
 *
 */

namespace Api\Model\Product;


use Api\Model\ReadingMapperInterface;
use RuntimeException;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGatewayInterface;

class ProductTable implements ReadingMapperInterface
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function fetchList($category_id)
    {
        $category_id = (int) $category_id;

        return $this->tableGateway->select(function (Select $select) use ($category_id){
            $select
                ->join('categories_xref', 'products.id = categories_xref.product_id')
                ->where([
                    'category_id' => $category_id,
                    'active' => 1,
                    'deleted' => 0
                ])
                ->order('sorting ASC');
        });
    }

    public function fetch($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

}