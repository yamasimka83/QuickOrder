<?php
declare(strict_types=1);

namespace Lukas\QuickOrder\Repository;

use Exception;
use Lukas\QuickOrder\Api\Data\QuickOrderInterface;
use Lukas\QuickOrder\Api\Data\QuickOrderInterfaceFactory;
use Lukas\QuickOrder\Api\Data\QuickOrderSearchResultInterface;
use Lukas\QuickOrder\Api\Data\QuickOrderSearchResultInterfaceFactory;
use Lukas\QuickOrder\Api\QuickOrderRepositoryInterface;
use Lukas\QuickOrder\Model\ResourceModel\QuickOrder as ResourceModel;
use Lukas\QuickOrder\Model\ResourceModel\QuickOrder\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;

/**
 * Class QuickOrderRepository
 * @package Lukas\QuickOrder\Repository
 */
class QuickOrderRepository implements QuickOrderRepositoryInterface
{

    /**
     * @var ResourceModel
     */
    private $resourceModel;

    /**
     * @var QuickOrderInterfaceFactory
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
     * @var QuickOrderSearchResultInterfaceFactory
     */
    private $searchResultFactory;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * QuickRepository constructor.
     * @param ResourceModel $resourceModel
     * @param QuickOrderInterfaceFactory $quickOrderInterfaceFactory
     * @param CollectionFactory $collectionFactory
     * @param QuickOrderSearchResultInterfaceFactory $searchResultFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param LoggerInterface $logger
     */
    public function __construct(
        ResourceModel $resourceModel,
        QuickOrderInterfaceFactory $quickOrderInterfaceFactory,
        CollectionFactory $collectionFactory,
        QuickOrderSearchResultInterfaceFactory $searchResultFactory,
        CollectionProcessorInterface $collectionProcessor,
        LoggerInterface $logger
    ) {
        $this->resourceModel        = $resourceModel;
        $this->modelFactory         = $quickOrderInterfaceFactory;
        $this->collectionFactory    = $collectionFactory;
        $this->searchResultFactory  = $searchResultFactory;
        $this->collectionProcessor  = $collectionProcessor;
        $this->logger               = $logger;
    }

    /**
     * @param int $id
     * @return QuickOrderInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): QuickOrderInterface
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
     * @return QuickOrderSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): QuickOrderSearchResultInterface
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
     * @param QuickOrderInterface $order
     * @return QuickOrderInterface
     * @throws CouldNotSaveException
     */
    public function save(QuickOrderInterface $order): QuickOrderInterface
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
     * @param QuickOrderInterface $order
     * @return QuickOrderRepositoryInterface
     * @throws CouldNotDeleteException
     */
    public function delete(QuickOrderInterface $order): QuickOrderRepositoryInterface
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
     * @return QuickOrderRepositoryInterface
     * @throws CouldNotDeleteException
     */
    public function deleteById(int $id): QuickOrderRepositoryInterface
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
