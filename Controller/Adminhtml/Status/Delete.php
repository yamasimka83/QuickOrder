<?php
declare(strict_types=1);

namespace Lukas\QuickOrder\Controller\Adminhtml\Status;

use Lukas\QuickOrder\Api\Data\QuickStatusInterfaceFactory;
use Lukas\QuickOrder\Api\QuickStatusRepositoryInterface;
use Lukas\QuickOrder\Model\ResourceModel\QuickStatus\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;
use Psr\Log\LoggerInterface;

/**
 * Class Delete
 * @package Lukas\QuickOrder\Controller\Adminhtml\Status
 */
class Delete extends Action
{

    /**
     * @var QuickStatusInterfaceFactory
     */
    private $modelFactory;

    /**
     * @var QuickStatusRepositoryInterface
     */
    private $repository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var Filter
     */
    private $filter;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * Delete constructor.
     * @param Context $context
     * @param QuickStatusInterfaceFactory $quickStatusInterfaceFactory
     * @param QuickStatusRepositoryInterface $repository
     * @param LoggerInterface $logger
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        QuickStatusInterfaceFactory $quickStatusInterfaceFactory,
        QuickStatusRepositoryInterface $repository,
        LoggerInterface $logger,
        Filter $filter,
        CollectionFactory $collectionFactory
    ) {
        $this->repository       = $repository;
        $this->modelFactory     = $quickStatusInterfaceFactory;
        $this->logger           = $logger;
        $this->filter           = $filter;
        $this->collectionFactory = $collectionFactory;

        parent::__construct($context);
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Lukas_QuickOrder::all');
    }

    /**
     * @return ResponseInterface|ResultInterface
     * @throws LocalizedException
     */
    public function execute()
    {
        try {
            $quickStatusesCollection = $this->filter->getCollection($this->collectionFactory->create());
            $collectionSize = $quickStatusesCollection->getSize();

            foreach ($quickStatusesCollection as $item) {
                $item->delete();
            }
            $this->messageManager->addSuccessMessage(__('Statuses Deleted Successfully.'));
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        return  $this->_redirect('*/*/');
    }
}
