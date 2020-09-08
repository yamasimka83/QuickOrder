<?php
declare(strict_types=1);

namespace Lukas\QuickOrder\Api;

use Lukas\QuickOrder\Api\Data\QuickOrderInterface;
use Lukas\QuickOrder\Api\Data\QuickOrderSearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface QuickOrderRepositoryInterface
 * @package Lukas\QuickOrder\Api
 */
interface QuickOrderRepositoryInterface
{

    /**
     * @param int $id
     * @return QuickOrderInterface
     */
    public function getById(int $id) : QuickOrderInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return QuickOrderSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria) : QuickOrderSearchResultInterface;

    /**
     * @param QuickOrderInterface $order
     * @return QuickOrderInterface
     */
    public function save(QuickOrderInterface $order) : QuickOrderInterface;

    /**
     * @param QuickOrderInterface $order
     * @return QuickOrderRepositoryInterface
     */
    public function delete(QuickOrderInterface $order) : QuickOrderRepositoryInterface;

    /**
     * @param int $id
     * @return QuickOrderRepositoryInterface
     */
    public function deleteById(int $id) : QuickOrderRepositoryInterface;
}
