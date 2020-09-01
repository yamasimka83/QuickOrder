<?php
declare(strict_types=1);

namespace Lukas\QuickOrder\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Quick
 * @package Lukas\QuickOrder\Model\ResourceModel
 */
class Quick extends AbstractDb
{

    protected function _construct()
    {
        $this->_init('quick_order', 'order_id');
    }
}
