;+(function($){
    'use strict'
    //Data hightlight;
    $("[data-action=hightlight]").each(function(index,item){
        let self = $(item);
        //Register action;
        self.on('focus', function(e){
            //get target;
            let target = $(self.data('target'));
            target.addClass('active');
        });
        self.on('blur', function(e){
            //get target;
            let target = $(self.data('target'));
            target.removeClass('active');
        });
    });
    //Data tabs switch
    $('[data-action="nav-tabs"]').each(function(index,item){
        let self = $(item);
        //Register action
        self.on('click', function (e) {
            e.preventDefault();
            if (!self.hasClass('active')) {
                $('[data-action="nav-tabs"].active').removeClass('active');
                //hide all .nav-contents;
                $('.nav-contents').addClass('hidden');
                $(self.data('target')).removeClass('hidden');
                self.addClass('active');
            }
        })
    });
    //Bank Search
    $('[data-action="banksearch"]').each(function(index, item) {
        let self = $(item);
        self.on('focus', function (e) {
            e.preventDefault();
            if (!$('body').hasClass('modal-open')) {
                $('body').addClass('modal-open').append('<div id="search-overbg"></div>');
            }
        });
        // self.on('blur', function (e) {
        $('body').on('click','#search-overbg', function(e){
            e.preventDefault();
            $('body').removeClass('modal-open').find('#search-overbg').remove();
            $(self.data('target')).addClass('hidden');
            self.val('');
        });
        self.on('keyup', function(e){
            let items = $(self.data('db-item'));
            items.addClass('hidden');
            let keyword = self.val();
            let hasResult = false;
            items.each(function(index, sitem) {
                let searchItem = $(sitem);
                if (searchItem.data('markup').startsWith(keyword.toLowerCase())) {
                    hasResult = true;
                    searchItem.removeClass('hidden');
                }
                if (hasResult) {
                    $(self.data('target')).removeClass('hidden');
                } else {
                    $(self.data('target')).addClass('hidden');
                }
            });
        })
    });
})(jQuery);