<?php
declare(strict_types=1);

namespace Lukas\QuickOrder\Api\Data;

/**
 * Interface QuickStatusInterface
 * @package Lukas\QuickOrder\Api\Data
 */
interface QuickStatusInterface
{
    /**
     * @return int
     */
    public function getStatusId() : int;

    /**
     * @return string
     */
    public function getName() : string;

    /**
     * @param string $name
     * @return QuickStatusInterface
     */
    public function setName(string $name) : QuickStatusInterface;

    /**
     * @return string
     */
    public function getCreatedAt() : string;

    /**
     * @return string
     */
    public function getUpdatedAt() : string;
}
