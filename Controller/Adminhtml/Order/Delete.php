<?php
declare(strict_types=1);

namespace Lukas\QuickOrder\Controller\Adminhtml\Order;

use Lukas\QuickOrder\Api\Data\QuickInterfaceFactory;
use Lukas\QuickOrder\Api\QuickRepositoryInterface;
use Lukas\QuickOrder\Model\ResourceModel\Quick\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;
use Psr\Log\LoggerInterface;

/**
 * Class Delete
 * @package Lukas\QuickOrder\Controller\Adminhtml\Order
 */
class Delete extends Action
{

    /**
     * @var QuickInterfaceFactory
     */
    private $modelFactory;

    /**
     * @var QuickRepositoryInterface
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
     * @param QuickInterfaceFactory $quickInterfaceFactory
     * @param QuickRepositoryInterface $repository
     * @param LoggerInterface $logger
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        QuickInterfaceFactory $quickInterfaceFactory,
        QuickRepositoryInterface $repository,
        LoggerInterface $logger,
        Filter $filter,
        CollectionFactory $collectionFactory
    ) {
        $this->repository       = $repository;
        $this->modelFactory     = $quickInterfaceFactory;
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
            $quickOrdersCollection = $this->filter->getCollection($this->collectionFactory->create());
            $collectionSize = $quickOrdersCollection->getSize();

            foreach ($quickOrdersCollection as $item) {
                $item->delete();
            }
            $this->messageManager->addSuccessMessage(__('Quick Orders Deleted Successfully.'));
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        return  $this->_redirect('*/*/');
    }
}
