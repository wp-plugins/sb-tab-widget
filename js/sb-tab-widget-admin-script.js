(function($){
    var body = $('body');

    (function(){
        // Xóa sidebar đang chứa SB Tab Widget
        var sidebar = $('div.widgets-sortables');
        body.find(sidebar).each(function(){
            var that = $(this);
            removeParentSidebarInTab(that);
            that.bind('DOMNodeInserted DOMNodeRemoved', function() {
                removeParentSidebarInTab(that);
            });
        });

        function removeParentSidebarInTab(selector) {
            var sidebarId = selector.attr('id');
            selector.find('p.list-sidebar').each(function(){
                var that = $(this),
                    sidebarOption = that.find('.sb-list-sidebars option[value="' + sidebarId + '"]');
                sidebarOption.remove();
            });
        }
    })();
})(jQuery);