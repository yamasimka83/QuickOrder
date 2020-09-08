<?php
declare(strict_types=1);

namespace Lukas\QuickOrder\Api;

use Lukas\QuickOrder\Api\Data\QuickStatusInterface;
use Lukas\QuickOrder\Api\Data\QuickStatusSearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface QuickRepositoryInterface
 * @package Lukas\QuickOrder\Api
 */
interface QuickStatusRepositoryInterface
{

    /**
     * @param int $id
     * @return QuickStatusInterface
     */
    public function getById(int $id) : QuickStatusInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return QuickStatusSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria) : QuickStatusSearchResultInterface;

    /**
     * @param QuickStatusInterface $order
     * @return QuickStatusInterface
     */
    public function save(QuickStatusInterface $order) : QuickStatusInterface;

    /**
     * @param QuickStatusInterface $order
     * @return QuickStatusRepositoryInterface
     */
    public function delete(QuickStatusInterface $order) : QuickStatusRepositoryInterface;

    /**
     * @param int $id
     * @return QuickStatusRepositoryInterface
     */
    public function deleteById(int $id) : QuickStatusRepositoryInterface;
}
