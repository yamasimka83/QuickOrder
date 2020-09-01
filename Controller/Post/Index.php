<?php
declare(strict_types=1);

namespace Lukas\QuickOrder\Controller\Post;

use Lukas\QuickOrder\Api\Data\QuickInterfaceFactory;
use Lukas\QuickOrder\Api\QuickRepositoryInterface;
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
     * @var QuickInterfaceFactory
     */
    private $quickFactory;

    /**
     * @var QuickRepositoryInterface
     */
    private $quickRepository;

    /**
     * Collect constructor.
     *
     * @param JsonFactory $resultJsonFactory
     * @param RequestInterface $request
     * @param QuickInterfaceFactory $quickFactory
     * @param QuickRepositoryInterface $quickRepository
     */
    public function __construct(
        JsonFactory $resultJsonFactory,
        RequestInterface $request,
        QuickInterfaceFactory $quickFactory,
        QuickRepositoryInterface $quickRepository
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->request = $request;
        $this->quickFactory = $quickFactory;
        $this->quickRepository = $quickRepository;
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

            $order = $this->quickFactory->create();
            $order->setName($name);
            $order->setEmail($email);
            $order->setSku($sku);
            $order->setPhone($phone);
            $order->setQty((int)$qty);
            $order->setComment($comment);
            $this->quickRepository->save($order);

//            $result->setData($order);
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
