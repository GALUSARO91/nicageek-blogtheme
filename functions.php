<?php
function ngbt_assets(){
    // register bootstrap and google fonts
    wp_enqueue_style("google-font",'"https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;700&family=DynaPuff:wght@400;500;700&family=Quicksand:wght@300;400;500;700&display=swap',array(),false,'all');
    wp_enqueue_style("bootstrap","https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css",array(),"5-3",'all');
    wp_enqueue_script("boostrap-js","https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js");
}

add_action("wp_enqueue_scripts","ngbt_assets");

function ngbt_register_custom_logo( $wp_customize ) {
    // Add a setting for logo upload
    $wp_customize->add_setting( 'logo' );
    // Add a control for logo upload
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo', array(
       'label'    => __( 'Upload logo', 'mytheme' ),
       'section'  => 'title_tagline',
       'settings' => 'logo',
    ) ) );
 }
 add_action( 'customize_register', 'ngbt_register_custom_logo' );