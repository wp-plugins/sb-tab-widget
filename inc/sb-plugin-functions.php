<?php
function sb_tab_widget_get_sidebars() {
    $options = SB_Option::get();
    $sidebar_count = isset($options['tab_widget']['sidebar']['count']) ? $options['tab_widget']['sidebar']['count'] : 0;
    $list_sidebars = array();
    for($i = 1; $i <= $sidebar_count; $i++) {
        $sidebar_name = isset($options['tab_widget']['sidebar'][$i]['name']) ? $options['tab_widget']['sidebar'][$i]['name'] : '';
        $sidebar_description = isset($options['tab_widget']['sidebar'][$i]['description']) ? $options['tab_widget']['sidebar'][$i]['description'] : '';
        $sidebar_id = isset($options['tab_widget']['sidebar'][$i]['id']) ? $options['tab_widget']['sidebar'][$i]['id'] : '';
        $sidebar = array(
            'id' => $sidebar_id,
            'name' => $sidebar_name,
            'description' => $sidebar_description
        );
        array_push($list_sidebars, $sidebar);
    }
    return $list_sidebars;
}

function sb_tab_widget_testing() {
    return apply_filters('sb_tab_widget_testing', false);
}