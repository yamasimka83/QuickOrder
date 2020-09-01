<?php
declare(strict_types=1);

namespace Lukas\QuickOrder\Api\Data;

/**
 * Interface QuickInterface
 * @package Lukas\QuickOrder\Api\Data
 */
interface QuickInterface
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
     * @return QuickInterface
     */
    public function setSku(string $sku) : QuickInterface;

    /**
     * @return string
     */
    public function getName() : string;

    /**
     * @param string $name
     * @return QuickInterface
     */
    public function setName(string $name) : QuickInterface;

    /**
     * @return string
     */
    public function getEmail() : string;

    /**
     * @param string $email
     * @return QuickInterface
     */
    public function setEmail(string $email) : QuickInterface;

    /**
     * @return string
     */
    public function getPhone() : string;

    /**
     * @param string $phone
     * @return QuickInterface
     */
    public function setPhone(string $phone) : QuickInterface;

    /**
     * @return int
     */
    public function getQty() : int;

    /**
     * @param int $qty
     * @return QuickInterface
     */
    public function setQty(int $qty) : QuickInterface;

    /**
     * @return string
     */
    public function getComment() : string;

    /**
     * @param string $comment
     * @return QuickInterface
     */
    public function setComment(string $comment) : QuickInterface;

    /**
     * @return string
     */
    public function getStatus() : string;

    /**
     * @param string $status
     * @return QuickInterface
     */
    public function setStatus(string $status) : QuickInterface;

    /**
     * @return string
     */
    public function getCreatedAt() : string;

    /**
     * @return string
     */
    public function getUpdatedAt() : string;





}
