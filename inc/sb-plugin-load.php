<?php
require SB_TAB_WIDGET_INC_PATH . '/sb-plugin-install.php';

if(!sb_tab_widget_check_core()) {
    return;
}

require SB_TAB_WIDGET_INC_PATH . '/sb-plugin-functions.php';

require SB_TAB_WIDGET_INC_PATH . '/class-sb-tab-widget.php';

require SB_TAB_WIDGET_INC_PATH . '/sb-plugin-admin.php';

require SB_TAB_WIDGET_INC_PATH . '/sb-plugin-hook.php';