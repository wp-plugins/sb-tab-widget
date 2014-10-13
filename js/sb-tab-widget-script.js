(function($){
    var body = $('body');
    (function(){
        // SB Tab Widget
        body.find('.sb-tab-widget').each(function(){
            var aTab = $(this), listTab = aTab.find('ul.list-tab'), tabContent = aTab.find('div.tab-content');
            tabContent.children('div.tab-item').each(function(){
                var widgetId = $(this).attr('id');
                $(this).find('a.tab-title').attr('href', '#' + widgetId).wrap('<li></li>').parent().detach().appendTo(listTab);
            });
            listTab.find('li:first-child').addClass('active');
            tabContent.find('div:first-child').addClass('active');
            if(listTab.is(':empty')) {
                listTab.closest('div').find('div.tab-content').css({'marginTop': 0});
            }

            aTab.find('a.tab-title').each(function(){
                var tabButton = $(this);
                tabButton.click(function(){
                    aTab.find('ul.nav > li').each(function(){
                        $(this).removeClass('active');
                    });
                    $(this).parent().addClass('active');
                    $(this).closest('div.sb-tab-widget').find('div.tab-content > div').each(function(){
                        $(this).removeClass('active');
                    });
                    $($(this).attr('href')).addClass('active');
                    return false;
                });
            });
        });

        $('.widget_sb_tab > div').css({'display': 'block'});
        $('.sb-tab-widget .sb-tabs').css({'display': 'inline-block'});
    })();
})(jQuery);