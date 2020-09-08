<?php
declare(strict_types=1);

namespace Lukas\QuickOrder\Model;

use Lukas\QuickOrder\Api\Data\QuickOrderInterface;
use Lukas\QuickOrder\Model\ResourceModel\QuickOrder as ResourceModel;
use Magento\Framework\Model\AbstractModel;

/**
 * Class QuickOrder
 * @package Lukas\QuickOrder\Model
 */
class QuickOrder extends AbstractModel implements QuickOrderInterface
{

    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->getData('order_id');
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->getData('sku');
    }

    /**
     * @param string $sku
     * @return QuickOrderInterface
     */
    public function setSku(string $sku): QuickOrderInterface
    {
        $this->setData('sku', $sku);

        return $this;
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
     * @return QuickOrderInterface
     */
    public function setName(string $name): QuickOrderInterface
    {
        $this->setData('name', $name);

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->getData('email');
    }

    /**
     * @param string $email
     * @return QuickOrderInterface
     */
    public function setEmail(string $email): QuickOrderInterface
    {
        $this->setData('email', $email);

        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->getData('phone');
    }

    /**
     * @param string $phone
     * @return QuickOrderInterface
     */
    public function setPhone(string $phone): QuickOrderInterface
    {
        $this->setData('phone', $phone);

        return $this;
    }

    /**
     * @return int
     */
    public function getQty(): int
    {
        return $this->getData('qty');
    }

    /**
     * @param int $qty
     * @return QuickOrderInterface
     */
    public function setQty(int $qty): QuickOrderInterface
    {
        $this->setData('qty', $qty);

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

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->getData('comment');
    }

    /**
     * @param string $comment
     * @return QuickOrderInterface
     */
    public function setComment(string $comment): QuickOrderInterface
    {
        $this->setData('comment', $comment);

        return $this;
    }

    /**
     * @return int
     */
    public function getStatusId(): int
    {
        return $this->getData('status');
    }

    /**
     * @param int $statusId
     * @return QuickOrderInterface
     */
    public function setStatusId(int $statusId): QuickOrderInterface
    {
        $this->setData('status', $statusId);

        return $this;
    }
}
