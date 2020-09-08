<?php
declare(strict_types=1);

namespace Lukas\QuickOrder\Repository;

use Exception;
use Lukas\QuickOrder\Api\Data\QuickStatusInterface;
use Lukas\QuickOrder\Api\Data\QuickStatusInterfaceFactory;
use Lukas\QuickOrder\Api\Data\QuickStatusSearchResultInterface;
use Lukas\QuickOrder\Api\Data\QuickStatusSearchResultInterfaceFactory;
use Lukas\QuickOrder\Api\QuickStatusRepositoryInterface;
use Lukas\QuickOrder\Model\ResourceModel\QuickStatus as ResourceModel;
use Lukas\QuickOrder\Model\ResourceModel\QuickStatus\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;

/**
 * Class QuickStatusRepository
 * @package Lukas\QuickOrder\Repository
 */
class QuickStatusRepository implements QuickStatusRepositoryInterface
{

    /**
     * @var ResourceModel
     */
    private $resourceModel;

    /**
     * @var QuickStatusInterfaceFactory
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
     * @var QuickStatusSearchResultInterfaceFactory
     */
    private $searchResultFactory;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * QuickRepository constructor.
     * @param ResourceModel $resourceModel
     * @param QuickStatusInterfaceFactory $quickStatusInterfaceFactory
     * @param CollectionFactory $collectionFactory
     * @param QuickStatusSearchResultInterfaceFactory $searchResultFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param LoggerInterface $logger
     */
    public function __construct(
        ResourceModel $resourceModel,
        QuickStatusInterfaceFactory $quickStatusInterfaceFactory,
        CollectionFactory $collectionFactory,
        QuickStatusSearchResultInterfaceFactory $searchResultFactory,
        CollectionProcessorInterface $collectionProcessor,
        LoggerInterface $logger
    ) {
        $this->resourceModel        = $resourceModel;
        $this->modelFactory         = $quickStatusInterfaceFactory;
        $this->collectionFactory    = $collectionFactory;
        $this->searchResultFactory  = $searchResultFactory;
        $this->collectionProcessor  = $collectionProcessor;
        $this->logger               = $logger;
    }

    /**
     * @param int $id
     * @return QuickStatusInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): QuickStatusInterface
    {
        $model = $this->modelFactory->create();

        $this->resourceModel->load($model, $id);

        if (null === $model->getStatusId()) {
            throw new NoSuchEntityException(__('Model with %1 not found', $id));
        }

        return $model;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return QuickStatusSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): QuickStatusSearchResultInterface
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
     * @param QuickStatusInterface $status
     * @return QuickStatusInterface
     * @throws CouldNotSaveException
     */
    public function save(QuickStatusInterface $status): QuickStatusInterface
    {
        try {
            $this->resourceModel->save($status);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
            throw new CouldNotSaveException(__("Gift not saved"));
        }

        return $status;
    }

    /**
     * @param QuickStatusInterface $status
     * @return QuickStatusRepositoryInterface
     * @throws CouldNotDeleteException
     */
    public function delete(QuickStatusInterface $status): QuickStatusRepositoryInterface
    {
        try {
            $this->resourceModel->delete($status);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
            throw new CouldNotDeleteException(__("Gift %1 not deleted", $status->getStatusId()));
        }
        return $this;
    }

    /**
     * @param int $id
     * @return QuickStatusRepositoryInterface
     * @throws CouldNotDeleteException
     */
    public function deleteById(int $id): QuickStatusRepositoryInterface
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
