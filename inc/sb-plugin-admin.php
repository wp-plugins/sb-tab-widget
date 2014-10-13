<?php
function sb_tab_widget_menu() {
    SB_Admin_Custom::add_submenu_page('SB Tab Widget', 'sb_tab_widget', array('SB_Admin_Custom', 'setting_page_callback'));
}
add_action('sb_admin_menu', 'sb_tab_widget_menu');

function sb_tab_widget_tab($tabs) {
    $tabs['sb_tab_widget'] = array('title' => 'SB Tab Widget', 'section_id' => 'sb_tab_widget_section', 'type' => 'plugin');
    return $tabs;
}
add_filter('sb_admin_tabs', 'sb_tab_widget_tab');

function sb_tab_widget_setting_field() {
    SB_Admin_Custom::add_section('sb_tab_widget_section', __('SB Tab Widget options page', 'sb-tab-widget'), 'sb_tab_widget');
    SB_Admin_Custom::add_setting_field('sb_tab_widget_sidebar', __('Tabber widget area', 'sb-tab-widget'), 'sb_tab_widget_section', 'sb_tab_widget_sidebar_callback', 'sb_tab_widget');
}
add_action('sb_admin_init', 'sb_tab_widget_setting_field');

function sb_tab_widget_sidebar_callback() {
    $id = 'sb_tab_widget_sidebar';
    $name = 'sb_options[tab_widget][sidebar]';
    $list_sidebars = sb_tab_widget_get_sidebars();
    $description = __('You can remove or create new widget area for displaying widget on tabber.', 'sb-tab-widget');
    $tabber_sidebar = SB_Core::get_sidebar_by('id', 'sb-tabber');
    $default_sidebars = array(
        array(
            'id' => $tabber_sidebar['id'],
            'name' => $tabber_sidebar['name'],
            'description' => $tabber_sidebar['description']
        )
    );
    $args = array(
        'id' => $id,
        'name' => $name,
        'list_sidebars' => $list_sidebars,
        'description' => $description,
        'default_sidebars' => $default_sidebars
    );
    SB_Field::widget_area($args);
}