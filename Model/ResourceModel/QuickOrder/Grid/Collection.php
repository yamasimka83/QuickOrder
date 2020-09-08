<?php
declare(strict_types=1);

namespace Lukas\QuickOrder\Model\ResourceModel\QuickOrder\Grid;

use Lukas\QuickOrder\Model\ResourceModel\QuickOrder as ResourceModel;
use Lukas\QuickOrder\Model\ResourceModel\QuickOrder\Collection as QuickCollection;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\Document;

/**
 * Class Collection
 * @package Lukas\QuickOrder\Model\ResourceModel\QuickOrder\Grid
 */
class Collection extends QuickCollection implements SearchResultInterface
{
    protected $aggregations;

    protected function _construct()
    {
        $this->_init(Document::class, ResourceModel::class);
    }

    /** {@inheritdoc} */
    public function getAggregations()
    {
        return $this->aggregations;
    }

    /** {@inheritdoc} */
    public function setAggregations($aggregations)
    {
        $this->aggregations = $aggregations;
    }

    /** {@inheritdoc} */
    public function getSearchCriteria()
    {
        return $this->searchCriteria;
    }

    /** {@inheritdoc} */
    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria = null)
    {
        $this->searchCriteria = $searchCriteria;

        return $this;
    }

    /** {@inheritdoc} */
    public function getTotalCount()
    {
        return $this->getSize();
    }

    /** {@inheritdoc} */
    public function setTotalCount($totalCount)
    {
        return $this;
    }

    /** {@inheritdoc} */
    public function setItems(array $items = null)
    {
        return $this;
    }

    /** {@inheritdoc} */
    public function getItems()
    {
        return $this;
    }
}
