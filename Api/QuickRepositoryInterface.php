<?php
declare(strict_types=1);

namespace Lukas\QuickOrder\Api;

use Lukas\QuickOrder\Api\Data\QuickInterface;
use Lukas\QuickOrder\Api\Data\QuickSearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface QuickRepositoryInterface
 * @package Lukas\QuickOrder\Api
 */
interface QuickRepositoryInterface
{

    /**
     * @param int $id
     * @return QuickInterface
     */
    public function getById(int $id) : QuickInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return QuickSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria) : QuickSearchResultInterface;

    /**
     * @param QuickInterface $order
     * @return QuickInterface
     */
    public function save(QuickInterface $order) : QuickInterface;

    /**
     * @param QuickInterface $order
     * @return QuickRepositoryInterface
     */
    public function delete(QuickInterface $order) : QuickRepositoryInterface;

    /**
     * @param int $id
     * @return QuickRepositoryInterface
     */
    public function deleteById(int $id) : QuickRepositoryInterface;
}
