<?php
declare(strict_types=1);

namespace Lukas\QuickOrder\Controller\Post;

use Lukas\QuickOrder\Api\Data\QuickOrderInterfaceFactory;
use Lukas\QuickOrder\Api\QuickOrderRepositoryInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NotFoundException;

/**
 * Class Index
 * @package Lukas\QuickOrder\Controller
 */
class Index implements HttpPostActionInterface
{
    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var QuickOrderInterfaceFactory
     */
    private $quickOrderFactory;

    /**
     * @var QuickOrderRepositoryInterface
     */
    private $quickOrderRepository;

    /**
     * Collect constructor.
     *
     * @param JsonFactory $resultJsonFactory
     * @param RequestInterface $request
     * @param QuickOrderInterfaceFactory $quickOrderFactory
     * @param QuickOrderRepositoryInterface $quickOrderRepository
     */
    public function __construct(
        JsonFactory $resultJsonFactory,
        RequestInterface $request,
        QuickOrderInterfaceFactory $quickOrderFactory,
        QuickOrderRepositoryInterface $quickOrderRepository
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->request = $request;
        $this->quickOrderFactory = $quickOrderFactory;
        $this->quickOrderRepository = $quickOrderRepository;
    }

    /**
     * Re-collect totals, to apply surcharge.
     *
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        $result = $this->resultJsonFactory->create();

        try {
            $this->_validateRequest();
            $name    = $this->request->getParam('name');
            $email   = $this->request->getParam('email');
            $phone   = $this->request->getParam('phone');
            $sku     = $this->request->getParam('sku');
            $qty     = $this->request->getParam('qty');
            $comment = $this->request->getParam('comment');

            $order = $this->quickOrderFactory->create();
            $order->setName($name);
            $order->setEmail($email);
            $order->setSku($sku);
            $order->setPhone($phone);
            $order->setQty((int)$qty);
            $order->setComment($comment);
            $this->quickOrderRepository->save($order);

        } catch (\Exception $exception) {
            return $result->setData($exception->getMessage());
        }

        return $result;
    }

    /**
     * Validates request.
     *
     * @return void
     *
     * @throws NotFoundException
     */
    protected function _validateRequest()
    {
        if (!$this->request->isAjax()) {
            throw new NotFoundException(__('Request type is incorrect'));
        }
    }
}
