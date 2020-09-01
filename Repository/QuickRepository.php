<?php
declare(strict_types=1);

namespace Lukas\QuickOrder\Repository;

use Exception;
use Lukas\QuickOrder\Api\Data\QuickInterface;
use Lukas\QuickOrder\Api\Data\QuickInterfaceFactory;
use Lukas\QuickOrder\Api\Data\QuickSearchResultInterface;
use Lukas\QuickOrder\Api\Data\QuickSearchResultInterfaceFactory;
use Lukas\QuickOrder\Api\QuickRepositoryInterface;
use Lukas\QuickOrder\Model\ResourceModel\Quick as ResourceModel;
use Lukas\QuickOrder\Model\ResourceModel\Quick\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;

/**
 * Class QuickRepository
 * @package Lukas\QuickOrder\Repository
 */
class QuickRepository implements QuickRepositoryInterface
{

    /**
     * @var ResourceModel
     */
    private $resourceModel;

    /**
     * @var QuickInterfaceFactory
     */
    private $modelFactory;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var QuickSearchResultInterfaceFactory
     */
    private $searchResultFactory;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * QuickRepository constructor.
     * @param ResourceModel $resourceModel
     * @param QuickInterfaceFactory $quickInterfaceFactory
     * @param CollectionFactory $collectionFactory
     * @param QuickSearchResultInterfaceFactory $searchResultFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param LoggerInterface $logger
     */
    public function __construct(
        ResourceModel $resourceModel,
        QuickInterfaceFactory $quickInterfaceFactory,
        CollectionFactory $collectionFactory,
        QuickSearchResultInterfaceFactory $searchResultFactory,
        CollectionProcessorInterface $collectionProcessor,
        LoggerInterface $logger
    ) {
        $this->resourceModel        = $resourceModel;
        $this->modelFactory         = $quickInterfaceFactory;
        $this->collectionFactory    = $collectionFactory;
        $this->searchResultFactory  = $searchResultFactory;
        $this->collectionProcessor  = $collectionProcessor;
        $this->logger               = $logger;
    }

    /**
     * @param int $id
     * @return QuickInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): QuickInterface
    {
        $model = $this->modelFactory->create();

        $this->resourceModel->load($model, $id);

        if (null === $model->getOrderId()) {
            throw new NoSuchEntityException(__('Model with %1 not found', $id));
        }

        return $model;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return QuickSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): QuickSearchResultInterface
    {
        $collection = $this->collectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResult = $this->searchResultFactory->create();

        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($collection->getData());

        return $searchResult;
    }

    /**
     * @param QuickInterface $order
     * @return QuickInterface
     * @throws CouldNotSaveException
     */
    public function save(QuickInterface $order): QuickInterface
    {
        try {
            $this->resourceModel->save($order);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
            throw new CouldNotSaveException(__("Gift not saved"));
        }

        return $order;
    }

    /**
     * @param QuickInterface $order
     * @return $this|QuickRepositoryInterface
     * @throws CouldNotDeleteException
     */
    public function delete(QuickInterface $order): QuickRepositoryInterface
    {
        try {
            $this->resourceModel->delete($order);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
            throw new CouldNotDeleteException(__("Gift %1 not deleted", $order->getOrderId()));
        }
        return $this;
    }

    /**
     * @param int $id
     * @return $this|QuickRepositoryInterface
     * @throws CouldNotDeleteException
     */
    public function deleteById(int $id): QuickRepositoryInterface
    {
        try {
            $model = $this->getById($id);
            $this->delete($model);
        } catch (NoSuchEntityException $e) {
            $this->logger->warning(sprintf("Gift %d already deleted or not found", $id));
        }

        return $this;
    }
}
