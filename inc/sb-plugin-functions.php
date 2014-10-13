<?php
function sb_tab_widget_check_core() {
    $activated_plugins = get_option('active_plugins');
    $sb_core_installed = in_array('sb-core/sb-core.php', $activated_plugins);
    if(!$sb_core_installed) {
        $sb_plugins = array(SB_TAB_WIDGET_BASENAME);
        $activated_plugins = get_option('active_plugins');
        $activated_plugins = array_diff($activated_plugins, $sb_plugins);
        update_option('active_plugins', $activated_plugins);
    }
    return $sb_core_installed;
}

sb_tab_widget_check_core();

function sb_tab_widget_activation() {
    if(!sb_tab_widget_check_core()) {
        wp_die(sprintf(__('You must install and activate plugin %1$s first! Click here to %2$s.', 'sb-tab-widget'), '<a href="https://wordpress.org/plugins/sb-core/">SB Core</a>', sprintf('<a href="%1$s">%2$s</a>', admin_url('plugins.php'), __('go back', 'sb-tab-widget'))));
    }
    do_action('sb_tab_widget_activation');
}
register_activation_hook(SB_TAB_WIDGET_FILE, 'sb_tab_widget_activation');

function sb_tab_widget_settings_link($links) {
    if(sb_tab_widget_check_core()) {
        $settings_link = sprintf('<a href="admin.php?page=sb_tab_widget">%s</a>', __('Settings', 'sb-tab-widget'));
        array_unshift($links, $settings_link);
    }
    return $links;
}
add_filter('plugin_action_links_' . SB_TAB_WIDGET_BASENAME, 'sb_tab_widget_settings_link');

function sb_tab_widget_textdomain() {
    load_plugin_textdomain( 'sb-tab-widget', false, SB_TAB_WIDGET_DIRNAME . '/languages/' );
}
add_action('plugins_loaded', 'sb_tab_widget_textdomain');

function sb_tab_widget_init() {
    register_widget('SB_Tab_Widget');
}
add_action('widgets_init', 'sb_tab_widget_init');

function sb_tab_widget_load_sidebar() {
    register_sidebar(array(
        'name'          => __( 'Tabber Widgets', 'sb-tab-widget' ),
        'id'            => 'sb-tabber',
        'description'   => __( 'Display widgets as tabber.', 'sb-tab-widget' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
    $list_sidebars = sb_tab_widget_get_sidebars();
    foreach($list_sidebars as $sidebar) {
        $sidebar_id = $sidebar['id'];
        $sidebar_name = $sidebar['name'];
        $sidebar_description = $sidebar['description'];
        if(!empty($sidebar_id) && !empty($sidebar_name) && !empty($sidebar_description)) {
            SB_Core::register_sidebar($sidebar_id, $sidebar_name, $sidebar_description);
        }
    }
}
add_action('wp_loaded', 'sb_tab_widget_load_sidebar');

function sb_tab_widget_style_and_script() {
    wp_register_style('sb-tab-widget-style', SB_TAB_WIDGET_URL . '/css/sb-tab-widget-style.css');
    wp_enqueue_style('sb-tab-widget-style');
    wp_enqueue_script('sb-tab-widget', SB_TAB_WIDGET_URL . '/js/sb-tab-widget-script.js', array('jquery'), false, true);
}
add_action('wp_enqueue_scripts', 'sb_tab_widget_style_and_script');

function sb_tab_widget_admin_style_and_script() {
    $screen = get_current_screen();
    if ( 'widgets' == $screen->base ) {
        wp_register_script('sb-tab-widget-admin', SB_TAB_WIDGET_URL . '/js/sb-tab-widget-admin-script.js', array('jquery'), false, true);
        wp_enqueue_script('sb-tab-widget-admin');
    }
}
add_action('admin_enqueue_scripts', 'sb_tab_widget_admin_style_and_script');

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

require SB_TAB_WIDGET_INC_PATH . '/sb-plugin-load.php';