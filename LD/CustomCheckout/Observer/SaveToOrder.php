<?php
namespace LD\CustomCheckout\Observer;

class SaveToOrder implements \Magento\Framework\Event\ObserverInterface
{   
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $event = $observer->getEvent();
        $quote = $event->getQuote();
    	$order = $event->getOrder();
           $order->setData('address_type', $quote->getData('address_type'));
    }
}