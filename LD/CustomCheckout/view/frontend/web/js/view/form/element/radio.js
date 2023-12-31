define([
    'Magento_Ui/js/form/element/abstract',
    'jquery'
], function(Abstract, $) {
    'use strict';

    return Abstract.extend({
        initialize: function () {
            this._super();

            return this;
        },

        /**
         * Handle radio click, return true to check te radio
         */
        click: function(data, event) {
            this.change(event.target.value);

            return true;
        },

        /**
         * Change value of radio
         */
        /*change: function(value) {
            if (value === 'home') {
            	alert("HOme");
            } else if (value === 'work') {
                alert("b");
            } else if (value === 'neighbour') {
                alert("neighbour");
            }

        }*/
    });
});