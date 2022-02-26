/*--------------------- Copyright (c) 2020 -----------------------
[Master Javascript]
Project: Multifarious Services - Responsive HTML Template
Version: 1.0.0
Assigned to: Theme Forest
-------------------------------------------------------------------*/
(function($) {
    "use strict";
    /*-----------------------------------------------------
    	Function  Start
    -----------------------------------------------------*/
    var Multifarious = {
        initialised: false,
        version: 1.0,
        mobile: false,
        init: function() {
            if (!this.initialised) {
                this.initialised = true;
            } else {
                return;
            }
            /*-----------------------------------------------------
            	Function Calling
            -----------------------------------------------------*/
            ;
            this.searchBox();


        },

        /*-----------------------------------------------------
        	Fix Search Bar & Cart
        -----------------------------------------------------*/
        searchBox: function() {
            $('.searchBtn').on("click", function() {
                $('.searchBox').addClass('show');
            });
            $('.closeBtn').on("click", function() {
                $('.searchBox').removeClass('show');
            });
            $('.searchBox').on("click", function() {
                $('.searchBox').removeClass('show');
            });
            $(".search_bar_inner").on('click', function() {
                event.stopPropagation();
            });
        },








    };

    Multifarious.init();

})(jQuery);


