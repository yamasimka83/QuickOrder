<?php
declare(strict_types=1);

namespace Lukas\QuickOrder\Controller\Adminhtml\Order;

use Lukas\QuickOrder\Api\Data\QuickOrderInterfaceFactory;
use Lukas\QuickOrder\Api\QuickOrderRepositoryInterface;
use Lukas\QuickOrder\Model\ResourceModel\QuickOrder\CollectionFactory;
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
     * @var QuickOrderInterfaceFactory
     */
    private $modelFactory;

    /**
     * @var QuickOrderRepositoryInterface
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
     * @param QuickOrderInterfaceFactory $quickOrderInterfaceFactory
     * @param QuickOrderRepositoryInterface $repository
     * @param LoggerInterface $logger
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        QuickOrderInterfaceFactory $quickOrderInterfaceFactory,
        QuickOrderRepositoryInterface $repository,
        LoggerInterface $logger,
        Filter $filter,
        CollectionFactory $collectionFactory
    ) {
        $this->repository       = $repository;
        $this->modelFactory     = $quickOrderInterfaceFactory;
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
