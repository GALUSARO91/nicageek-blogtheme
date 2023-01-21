<?php
function ngbt_assets(){
    // register bootstrap and google fonts
    wp_enqueue_style("google-font",'"https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;700&family=DynaPuff:wght@400;500;700&family=Quicksand:wght@300;400;500;700&display=swap',array(),false,'all');
    wp_enqueue_style("bootstrap","https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css",array(),"5-3",'all');
    wp_enqueue_script("boostrap-js","https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js");
}

add_action("wp_enqueue_scripts","ngbt_assets");

function ngbt_register_theme_supports() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo',
        array( 'width' => 100,
        'height' => 100,
        'flex-width' => true,
        'flex-height' => true)
    );
    add_theme_support("widgets");
 }
 add_action( 'customize_register', 'ngbt_register_theme_supports');

 function ngbt_outputlogo(){
    // Outputs logo URL into an img tag 
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $custom_logo_url = wp_get_attachment_image_url( $custom_logo_id , 'full' );
    return esc_url( $custom_logo_url );
 }

 function ngbt_register_menus(){
    register_nav_menus( ["menu-header"] );
 }