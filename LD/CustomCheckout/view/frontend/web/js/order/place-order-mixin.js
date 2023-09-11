define([
    'jquery',
    'mage/utils/wrapper',
    'Magento_CheckoutAgreements/js/model/agreements-assigner',
    'Magento_Checkout/js/model/quote',
    'Magento_Customer/js/model/customer',
    'Magento_Checkout/js/model/url-builder',
    'mage/url',
    'Magento_Checkout/js/model/error-processor',
    'uiRegistry'
], function (
    $, 
    wrapper, 
    agreementsAssigner,
    quote,
    customer,
    urlBuilder, 
    urlFormatter, 
    errorProcessor,
    registry
) {
    'use strict';

    return function (placeOrderAction) {
    	//alert("Call");
        /** Override default place order action and add agreement_ids to request */
        return wrapper.wrap(placeOrderAction, function (originalAction, paymentData, messageContainer) {
            agreementsAssigner(paymentData);
            var isCustomer = customer.isLoggedIn();
            var quoteId = quote.getQuoteId();

            var url = urlFormatter.build('customcheckout/quote/save');

            var addressType = $('[name="address_type"]:checked').val();
            if (addressType) {

                var payload = {
                    'cartId': quoteId,
                    'address_type': addressType,
                    'is_customer': isCustomer
                };

                if (!payload.address_type) {
                    return true;
                }

                var result = true;

                $.ajax({
                    url: url,
                    data: payload,
                    dataType: 'text',
                    type: 'POST',
                }).done(
                    function (response) {
                        result = true;
                        console.log("Transfered");
                    }
                ).fail(
                    function (response) {
                        result = false;
                        errorProcessor.process(response);
                    }
                );
            }
            
            return originalAction(paymentData, messageContainer);
        });
    };
});