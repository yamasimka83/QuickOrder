<?php
declare(strict_types=1);

namespace Lukas\QuickOrder\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class QuickStatus
 * @package Lukas\QuickOrder\Model\ResourceModel
 */
class QuickStatus extends AbstractDb
{

    protected function _construct()
    {
        $this->_init('quick_order_statuses', 'status_id');
    }
}
