<?php
declare(strict_types=1);

namespace Lukas\QuickOrder\Model\ResourceModel\QuickOrder;

use Lukas\QuickOrder\Model\QuickOrder;
use Lukas\QuickOrder\Model\ResourceModel\QuickOrder as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Lukas\QuickOrder\Model\ResourceModel\QuickOrder
 */
class Collection extends AbstractCollection
{
    protected $_idFieldName = 'order_id';

    protected function _construct()
    {
        $this->_init(QuickOrder::class, ResourceModel::class);
    }
}
