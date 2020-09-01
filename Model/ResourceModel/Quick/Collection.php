<?php
declare(strict_types=1);

namespace Lukas\QuickOrder\Model\ResourceModel\Quick;

use Lukas\QuickOrder\Model\Quick;
use Lukas\QuickOrder\Model\ResourceModel\Quick as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Lukas\QuickOrder\Model\ResourceModel\Quick
 */
class Collection extends AbstractCollection
{
    protected $_idFieldName = 'order_id';

    protected function _construct()
    {
        $this->_init(Quick::class, ResourceModel::class);
    }
}
