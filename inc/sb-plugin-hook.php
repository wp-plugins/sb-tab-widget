<?php
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
    if(sb_tab_widget_testing()) {
        wp_register_style('sb-tab-widget-style', SB_TAB_WIDGET_URL . '/css/sb-tab-widget-style.css');
        wp_enqueue_script('sb-tab-widget', SB_TAB_WIDGET_URL . '/js/sb-tab-widget-script.js', array('jquery'), false, true);
    } else {
        wp_register_style('sb-tab-widget-style', SB_TAB_WIDGET_URL . '/css/sb-tab-widget-style.min.css');
        wp_enqueue_script('sb-tab-widget', SB_TAB_WIDGET_URL . '/js/sb-tab-widget-script.min.js', array('jquery'), false, true);
    }
    wp_enqueue_style('sb-tab-widget-style');
}
add_action('wp_enqueue_scripts', 'sb_tab_widget_style_and_script');

function sb_tab_widget_admin_style_and_script() {
    $screen = get_current_screen();
    if('widgets' == $screen->base) {
        if(sb_tab_widget_testing()) {
            wp_register_script('sb-tab-widget-admin', SB_TAB_WIDGET_URL . '/js/sb-tab-widget-admin-script.js', array('jquery'), false, true);
        } else {
            wp_register_script('sb-tab-widget-admin', SB_TAB_WIDGET_URL . '/js/sb-tab-widget-admin-script.min.js', array('jquery'), false, true);
        }
        wp_enqueue_script('sb-tab-widget-admin');
    }
    if(SB_Admin_Custom::is_sb_page()) {
        if(sb_tab_widget_testing()) {
            wp_enqueue_style('sb-tab-widget-admin-style', SB_TAB_WIDGET_URL . '/css/sb-tab-widget-admin-style.css');
        } else {
            wp_enqueue_style('sb-tab-widget-admin-style', SB_TAB_WIDGET_URL . '/css/sb-tab-widget-admin-style.min.css');
        }
    }
}
add_action('admin_enqueue_scripts', 'sb_tab_widget_admin_style_and_script');