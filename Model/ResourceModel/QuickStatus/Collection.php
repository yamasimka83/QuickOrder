<?php
declare(strict_types=1);

namespace Lukas\QuickOrder\Model\ResourceModel\QuickStatus;

use Lukas\QuickOrder\Model\QuickStatus;
use Lukas\QuickOrder\Model\ResourceModel\QuickStatus as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Lukas\QuickOrder\Model\ResourceModel\QuickStatus
 */
class Collection extends AbstractCollection
{
    protected $_idFieldName = 'status_id';

    protected function _construct()
    {
        $this->_init(QuickStatus::class, ResourceModel::class);
    }
}
