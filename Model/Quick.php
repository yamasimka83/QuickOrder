<?php
declare(strict_types=1);

namespace Lukas\QuickOrder\Model;

use Lukas\QuickOrder\Api\Data\QuickInterface;
use Lukas\QuickOrder\Model\ResourceModel\Quick as ResourceModel;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Quick
 * @package Lukas\QuickOrder\Model
 */
class Quick extends AbstractModel implements QuickInterface
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
     * @return QuickInterface
     */
    public function setSku(string $sku): QuickInterface
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
     * @return QuickInterface
     */
    public function setName(string $name): QuickInterface
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
     * @return QuickInterface
     */
    public function setEmail(string $email): QuickInterface
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
     * @return QuickInterface
     */
    public function setPhone(string $phone): QuickInterface
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
     * @return QuickInterface
     */
    public function setQty(int $qty): QuickInterface
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
     * @return $this|QuickInterface
     */
    public function setComment(string $comment): QuickInterface
    {
        $this->setData('comment', $comment);

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->getData('status');
    }

    /**
     * @param string $status
     * @return $this|QuickInterface
     */
    public function setStatus(string $status): QuickInterface
    {
        $this->setData('status', $status);

        return $this;
    }
}
