<?php
declare(strict_types=1);

namespace Lukas\QuickOrder\Model;

use Lukas\QuickOrder\Api\Data\QuickStatusInterface;
use Lukas\QuickOrder\Model\ResourceModel\QuickStatus as ResourceModel;
use Magento\Framework\Model\AbstractModel;

/**
 * Class QuickStatus
 * @package Lukas\QuickOrder\Model
 */
class QuickStatus extends AbstractModel implements QuickStatusInterface
{

    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @return int
     */
    public function getStatusId(): int
    {
        return $this->getData('status_id');
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->getData('name');
    }

    /**
     * @param string $name
     * @return QuickStatusInterface
     */
    public function setName(string $name): QuickStatusInterface
    {
        $this->setData('name', $name);

        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->getData('created_at');
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->getData('updated_at');
    }
}
