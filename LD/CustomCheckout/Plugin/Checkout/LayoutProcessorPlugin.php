<?php

namespace LD\CustomCheckout\Plugin\Checkout;

class LayoutProcessorPlugin
{
    /**
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array  $jsLayout
    ) {

        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children']['address_type'] = 
            $this->getSwitchField();

        return $jsLayout;
    }

    protected function getSwitchField()
    {
        $customAttributeCode = 'address_type';
        $customField = [
            'component' => 'LD_CustomCheckout/js/view/form/element/radio',
            'config' => [
                'customScope' => 'shippingAddress.custom_attributes',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'LD_CustomCheckout/form/element/radio'
            ],
            'dataScope' => 'shippingAddress.custom_attributes' . '.' . $customAttributeCode,
            'label' => __('Address Type'),
            'provider' => 'checkoutProvider',
            'sortOrder' => 0,
            'validation' => [
                'required-entry' => false
            ],
            'options' => [],
            'filterBy' => null,
            'customEntry' => null,
            'visible' => true,
        ];

        return $customField;
    }
}