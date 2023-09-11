<?php

namespace LD\CustomCheckout\Controller\Quote;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $quoteIdMaskFactory;

    protected $quoteRepository;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Quote\Model\QuoteIdMaskFactory $quoteIdMaskFactory,
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository
    ) {
        parent::__construct($context);
        $this->quoteRepository = $quoteRepository;
        $this->quoteIdMaskFactory = $quoteIdMaskFactory;
    }

    /**
     * @return \Magento\Framework\Controller\Result\Raw
     */
    public function execute()
    {
        $post = $this->getRequest()->getPostValue();
        /*echo "string";
        print_r($post); 
        echo $post['address_type'];
        exit;*/
        if ($post) {
            $cartId       = $post['cartId'];
            $addressType = $post['address_type'];
            $loggin       = $post['is_customer'];

            $cartId = $this->quoteIdMaskFactory->create()->load($cartId, 'masked_id')->getQuoteId();
            if ($loggin === 'false') {
            }

            $quote = $this->quoteRepository->getActive($cartId);
            if (!$quote->getItemsCount()) {
                throw new NoSuchEntityException(__('Cart %1 doesn\'t contain products', $cartId));
            }

            $quote->setData('address_type', $addressType);
            $this->quoteRepository->save($quote);
        }
    }
}