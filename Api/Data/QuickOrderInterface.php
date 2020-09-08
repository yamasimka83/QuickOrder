<?php
declare(strict_types=1);

namespace Lukas\QuickOrder\Api\Data;

/**
 * Interface QuickOrderInterface
 * @package Lukas\QuickOrder\Api\Data
 */
interface QuickOrderInterface
{
    /**
     * @return int
     */
    public function getOrderId() : int;

    /**
     * @return string
     */
    public function getSku() : string;

    /**
     * @param string $sku
     * @return QuickOrderInterface
     */
    public function setSku(string $sku) : QuickOrderInterface;

    /**
     * @return string
     */
    public function getName() : string;

    /**
     * @param string $name
     * @return QuickOrderInterface
     */
    public function setName(string $name) : QuickOrderInterface;

    /**
     * @return string
     */
    public function getEmail() : string;

    /**
     * @param string $email
     * @return QuickOrderInterface
     */
    public function setEmail(string $email) : QuickOrderInterface;

    /**
     * @return string
     */
    public function getPhone() : string;

    /**
     * @param string $phone
     * @return QuickOrderInterface
     */
    public function setPhone(string $phone) : QuickOrderInterface;

    /**
     * @return int
     */
    public function getQty() : int;

    /**
     * @param int $qty
     * @return QuickOrderInterface
     */
    public function setQty(int $qty) : QuickOrderInterface;

    /**
     * @return string
     */
    public function getComment() : string;

    /**
     * @param string $comment
     * @return QuickOrderInterface
     */
    public function setComment(string $comment) : QuickOrderInterface;

    /**
     * @return int
     */
    public function getStatusId() : int;

    /**
     * @param int $statusId
     * @return QuickOrderInterface
     */
    public function setStatusId(int $statusId) : QuickOrderInterface;

    /**
     * @return string
     */
    public function getCreatedAt() : string;

    /**
     * @return string
     */
    public function getUpdatedAt() : string;





}
